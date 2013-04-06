<?php

namespace AdrienBrault\SilexBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class ControllerResolverIntegrationPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $defaultCRDefinition = $container->findDefinition('controller_resolver');

        switch ($defaultCRDefinition->getClass()) {
            case '%jms_di_extra.controller_resolver.class%':
                $container->setAlias('controller_resolver', 'silex.controller_resolver.jms_diextra');
                break;

            case '%controller_resolver.class%':
                $container->setDefinition('silex.base_controller_resolver.symfony', $defaultCRDefinition);
                $crDefinition = new DefinitionDecorator('silex.base_controller_resolver.symfony');
                $crDefinition->setClass('%silex.controller_resolver.symfony.class%');
                $crDefinition->addMethodCall('setControllerCollection', array('%silex.controllers%'));
                $container->setDefinition('controller_resolver', $crDefinition);
                break;

            default:
                throw new \RuntimeException(sprintf('Controller resolver is not supported'));
        }
    }
}
