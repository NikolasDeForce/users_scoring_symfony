<?php

namespace ContainerONtftfX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getTexter_TransportsService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'texter.transports' shared service.
     *
     * @return \Symfony\Component\Notifier\Transport\Transports
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/notifier/Transport/TransportInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/notifier/Transport/Transports.php';

        return $container->privates['texter.transports'] = ($container->privates['texter.transport_factory'] ?? $container->load('getTexter_TransportFactoryService'))->fromStrings([]);
    }
}
