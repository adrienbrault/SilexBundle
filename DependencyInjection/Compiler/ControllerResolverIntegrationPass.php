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
        $container->setDefinition('silex.wrapped_controller_resolver', $defaultCRDefinition);
        $container->setAlias('controller_resolver', 'silex.controller_resolver');
    }
}
