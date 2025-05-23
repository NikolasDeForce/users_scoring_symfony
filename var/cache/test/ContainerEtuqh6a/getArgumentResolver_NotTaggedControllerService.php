<?php

namespace ContainerEtuqh6a;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getArgumentResolver_NotTaggedControllerService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private 'argument_resolver.not_tagged_controller' shared service.
     *
     * @return \Symfony\Component\HttpKernel\Controller\ArgumentResolver\NotTaggedControllerValueResolver
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ValueResolverInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Controller/ArgumentResolver/NotTaggedControllerValueResolver.php';

        $a = ($container->privates['.service_locator.IAPw26Z'] ?? $container->load('get_ServiceLocator_IAPw26ZService'));

        if (isset($container->privates['argument_resolver.not_tagged_controller'])) {
            return $container->privates['argument_resolver.not_tagged_controller'];
        }

        return $container->privates['argument_resolver.not_tagged_controller'] = new \Symfony\Component\HttpKernel\Controller\ArgumentResolver\NotTaggedControllerValueResolver($a);
    }
}
