<?php

namespace ContainerOkFvdYn;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getDoctrine_QueryDqlCommandService extends OrderExample_KernelDevDebugContainer
{
    /**
     * Gets the private 'doctrine.query_dql_command' shared service.
     *
     * @return \Doctrine\ORM\Tools\Console\Command\RunDqlCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/src/Tools/Console/Command/AbstractEntityManagerCommand.php';
        include_once \dirname(__DIR__, 4).'/vendor/doctrine/orm/src/Tools/Console/Command/RunDqlCommand.php';

        $container->privates['doctrine.query_dql_command'] = $instance = new \Doctrine\ORM\Tools\Console\Command\RunDqlCommand(($container->privates['doctrine.orm.command.entity_manager_provider'] ?? $container->load('getDoctrine_Orm_Command_EntityManagerProviderService')));

        $instance->setName('doctrine:query:dql');

        return $instance;
    }
}
