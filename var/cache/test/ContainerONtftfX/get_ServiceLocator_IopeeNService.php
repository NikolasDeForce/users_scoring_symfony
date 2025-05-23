<?php

namespace ContainerONtftfX;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_IopeeNService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.service_locator.IopeeN_' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.IopeeN_'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'user' => ['privates', '.errored..service_locator.IopeeN_.App\\Entity\\Users', NULL, 'Cannot autowire service ".service_locator.IopeeN_": it needs an instance of "App\\Entity\\Users" but this type has been excluded in "config/services.yaml".'],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
        ], [
            'user' => 'App\\Entity\\Users',
            'entityManager' => '?',
        ]);
    }
}
