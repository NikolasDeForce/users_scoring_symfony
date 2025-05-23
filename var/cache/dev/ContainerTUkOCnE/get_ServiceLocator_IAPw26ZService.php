<?php

namespace ContainerTUkOCnE;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_IAPw26ZService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.IAPw26Z' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.IAPw26Z'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'kernel::registerContainerConfiguration' => ['privates', '.service_locator.zHyJIs5.kernel::registerContainerConfiguration()', 'get_ServiceLocator_ZHyJIs5_KernelregisterContainerConfigurationService', true],
            'App\\Kernel::registerContainerConfiguration' => ['privates', '.service_locator.zHyJIs5.kernel::registerContainerConfiguration()', 'get_ServiceLocator_ZHyJIs5_KernelregisterContainerConfigurationService', true],
            'kernel::loadRoutes' => ['privates', '.service_locator.zHyJIs5.kernel::loadRoutes()', 'get_ServiceLocator_ZHyJIs5_KernelloadRoutesService', true],
            'App\\Kernel::loadRoutes' => ['privates', '.service_locator.zHyJIs5.kernel::loadRoutes()', 'get_ServiceLocator_ZHyJIs5_KernelloadRoutesService', true],
            'App\\Controller\\UsersController::index' => ['privates', '.service_locator.sCVTKmN.App\\Controller\\UsersController::index()', 'getUsersControllerindexService', true],
            'App\\Controller\\UsersController::new' => ['privates', '.service_locator.egipcEH.App\\Controller\\UsersController::new()', 'getUsersControllernewService', true],
            'App\\Controller\\UsersController::show' => ['privates', '.service_locator.M..mpr4.App\\Controller\\UsersController::show()', 'getUsersControllershowService', true],
            'App\\Controller\\UsersController::edit' => ['privates', '.service_locator.IopeeN_.App\\Controller\\UsersController::edit()', 'getUsersControllereditService', true],
            'App\\Controller\\UsersController::delete' => ['privates', '.service_locator.IopeeN_.App\\Controller\\UsersController::delete()', 'getUsersControllerdeleteService', true],
            'kernel:registerContainerConfiguration' => ['privates', '.service_locator.zHyJIs5.kernel::registerContainerConfiguration()', 'get_ServiceLocator_ZHyJIs5_KernelregisterContainerConfigurationService', true],
            'kernel:loadRoutes' => ['privates', '.service_locator.zHyJIs5.kernel::loadRoutes()', 'get_ServiceLocator_ZHyJIs5_KernelloadRoutesService', true],
            'App\\Controller\\UsersController:index' => ['privates', '.service_locator.sCVTKmN.App\\Controller\\UsersController::index()', 'getUsersControllerindexService', true],
            'App\\Controller\\UsersController:new' => ['privates', '.service_locator.egipcEH.App\\Controller\\UsersController::new()', 'getUsersControllernewService', true],
            'App\\Controller\\UsersController:show' => ['privates', '.service_locator.M..mpr4.App\\Controller\\UsersController::show()', 'getUsersControllershowService', true],
            'App\\Controller\\UsersController:edit' => ['privates', '.service_locator.IopeeN_.App\\Controller\\UsersController::edit()', 'getUsersControllereditService', true],
            'App\\Controller\\UsersController:delete' => ['privates', '.service_locator.IopeeN_.App\\Controller\\UsersController::delete()', 'getUsersControllerdeleteService', true],
        ], [
            'kernel::registerContainerConfiguration' => '?',
            'App\\Kernel::registerContainerConfiguration' => '?',
            'kernel::loadRoutes' => '?',
            'App\\Kernel::loadRoutes' => '?',
            'App\\Controller\\UsersController::index' => '?',
            'App\\Controller\\UsersController::new' => '?',
            'App\\Controller\\UsersController::show' => '?',
            'App\\Controller\\UsersController::edit' => '?',
            'App\\Controller\\UsersController::delete' => '?',
            'kernel:registerContainerConfiguration' => '?',
            'kernel:loadRoutes' => '?',
            'App\\Controller\\UsersController:index' => '?',
            'App\\Controller\\UsersController:new' => '?',
            'App\\Controller\\UsersController:show' => '?',
            'App\\Controller\\UsersController:edit' => '?',
            'App\\Controller\\UsersController:delete' => '?',
        ]);
    }
}
