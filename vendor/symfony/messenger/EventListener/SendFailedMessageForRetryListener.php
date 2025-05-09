<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Messenger\EventListener;

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;
use Symfony\Component\Messenger\Event\WorkerMessageRetriedEvent;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\RecoverableExceptionInterface;
use Symfony\Component\Messenger\Exception\RuntimeException;
use Symfony\Component\Messenger\Exception\UnrecoverableExceptionInterface;
use Symfony\Component\Messenger\Retry\RetryStrategyInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Symfony\Component\Messenger\Stamp\RedeliveryStamp;
use Symfony\Component\Messenger\Stamp\StampInterface;
use Symfony\Component\Messenger\Stamp\TransportMessageIdStamp;
use Symfony\Component\Messenger\Transport\Sender\SenderInterface;

/**
 * @author Tobias Schultze <http://tobion.de>
 */
class SendFailedMessageForRetryListener implements EventSubscriberInterface
{
    public function __construct(
        private ContainerInterface $sendersLocator,
        private ContainerInterface $retryStrategyLocator,
        private ?LoggerInterface $logger = null,
        private ?EventDispatcherInterface $eventDispatcher = null,
        private int $historySize = 10,
    ) {
    }

    public function onMessageFailed(WorkerMessageFailedEvent $event): void
    {
        $retryStrategy = $this->getRetryStrategyForTransport($event->getReceiverName());
        $envelope = $event->getEnvelope();
        $throwable = $event->getThrowable();

        $message = $envelope->getMessage();
        $context = [
            'class' => $message::class,
            'message_id' => $envelope->last(TransportMessageIdStamp::class)?->getId(),
        ];

        $shouldRetry = $retryStrategy && $this->shouldRetry($throwable, $envelope, $retryStrategy);

        $retryCount = RedeliveryStamp::getRetryCountFromEnvelope($envelope);
        if ($shouldRetry) {
            $event->setForRetry();

            ++$retryCount;

            $delay = $this->getWaitingTime($envelope, $throwable, $retryStrategy);

            $this->logger?->warning('Error thrown while handling message {class}. Sending for retry #{retryCount} using {delay} ms delay. Error: "{error}"', $context + ['retryCount' => $retryCount, 'delay' => $delay, 'error' => $throwable->getMessage(), 'exception' => $throwable]);

            // add the delay and retry stamp info
            $retryEnvelope = $this->withLimitedHistory($envelope, new DelayStamp($delay), new RedeliveryStamp($retryCount));

            // re-send the message for retry
            $retryEnvelope = $this->getSenderForTransport($event->getReceiverName())->send($retryEnvelope);

            $this->eventDispatcher?->dispatch(new WorkerMessageRetriedEvent($retryEnvelope, $event->getReceiverName()));
        } else {
            $this->logger?->critical('Error thrown while handling message {class}. Removing from transport after {retryCount} retries. Error: "{error}"', $context + ['retryCount' => $retryCount, 'error' => $throwable->getMessage(), 'exception' => $throwable]);
        }
    }

    /**
     * Adds stamps to the envelope by keeping only the First + Last N stamps.
     */
    private function withLimitedHistory(Envelope $envelope, StampInterface ...$stamps): Envelope
    {
        foreach ($stamps as $stamp) {
            $history = $envelope->all($stamp::class);
            if (\count($history) < $this->historySize) {
                $envelope = $envelope->with($stamp);
                continue;
            }

            $history = array_merge(
                [$history[0]],
                \array_slice($history, -$this->historySize + 2),
                [$stamp]
            );

            $envelope = $envelope->withoutAll($stamp::class)->with(...$history);
        }

        return $envelope;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            // must have higher priority than SendFailedMessageToFailureTransportListener
            WorkerMessageFailedEvent::class => ['onMessageFailed', 100],
        ];
    }

    private function shouldRetry(\Throwable $e, Envelope $envelope, RetryStrategyInterface $retryStrategy): bool
    {
        if ($e instanceof RecoverableExceptionInterface) {
            return true;
        }

        // if one or more nested Exceptions is an instance of RecoverableExceptionInterface we should retry
        // if ALL nested Exceptions are an instance of UnrecoverableExceptionInterface we should not retry
        if ($e instanceof HandlerFailedException) {
            $shouldNotRetry = true;
            foreach ($e->getWrappedExceptions() as $nestedException) {
                if ($nestedException instanceof RecoverableExceptionInterface) {
                    return true;
                }

                if (!$nestedException instanceof UnrecoverableExceptionInterface) {
                    $shouldNotRetry = false;
                    break;
                }
            }
            if ($shouldNotRetry) {
                return false;
            }
        }

        if ($e instanceof UnrecoverableExceptionInterface) {
            return false;
        }

        return $retryStrategy->isRetryable($envelope, $e);
    }

    private function getWaitingTime(Envelope $envelope, \Throwable $throwable, RetryStrategyInterface $retryStrategy): int
    {
        $delay = null;
        if ($throwable instanceof RecoverableExceptionInterface && method_exists($throwable, 'getRetryDelay')) {
            $delay = $throwable->getRetryDelay();
        }

        if ($throwable instanceof HandlerFailedException) {
            foreach ($throwable->getWrappedExceptions() as $nestedException) {
                if (!$nestedException instanceof RecoverableExceptionInterface
                    || !method_exists($nestedException, 'getRetryDelay')
                    || 0 > $retryDelay = $nestedException->getRetryDelay() ?? -1
                ) {
                    continue;
                }
                if ($retryDelay < ($delay ?? \PHP_INT_MAX)) {
                    $delay = $retryDelay;
                }
            }
        }

        return $delay ?? $retryStrategy->getWaitingTime($envelope, $throwable);
    }

    private function getRetryStrategyForTransport(string $alias): ?RetryStrategyInterface
    {
        if ($this->retryStrategyLocator->has($alias)) {
            return $this->retryStrategyLocator->get($alias);
        }

        return null;
    }

    private function getSenderForTransport(string $alias): SenderInterface
    {
        if ($this->sendersLocator->has($alias)) {
            return $this->sendersLocator->get($alias);
        }

        throw new RuntimeException(\sprintf('Could not find sender "%s" based on the same receiver to send the failed message to for retry.', $alias));
    }
}
