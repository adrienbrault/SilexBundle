<?php

namespace AdrienBrault\SilexBundle;

use AdrienBrault\SilexBundle\DependencyInjection\Compiler\ControllerResolverIntegrationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class SilexBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ControllerResolverIntegrationPass());
    }
}
