<?php

namespace ContainerNrWlxxk;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getOrderControllerService extends OrderExample_KernelDevDebugContainer
{
    /**
     * Gets the public 'OrderExample\Controller\OrderController' shared autowired service.
     *
     * @return \OrderExample\Controller\OrderController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/OrderController.php';

        $container->services['OrderExample\\Controller\\OrderController'] = $instance = new \OrderExample\Controller\OrderController();

        $instance->setContainer((new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'router' => ['services', 'router', 'getRouterService', false],
            'request_stack' => ['services', 'request_stack', 'getRequestStackService', false],
            'http_kernel' => ['services', 'http_kernel', 'getHttpKernelService', false],
            'form.factory' => ['privates', 'form.factory', 'getForm_FactoryService', true],
            'parameter_bag' => ['privates', 'parameter_bag', 'getParameterBagService', false],
        ], [
            'router' => '?',
            'request_stack' => '?',
            'http_kernel' => '?',
            'form.factory' => '?',
            'parameter_bag' => '?',
        ]))->withContext('OrderExample\\Controller\\OrderController', $container));

        return $instance;
    }
}
