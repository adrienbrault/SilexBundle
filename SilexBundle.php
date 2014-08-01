<?php

namespace AdrienBrault\SilexBundle;

use AdrienBrault\SilexBundle\DependencyInjection\Compiler\ControllerResolverIntegrationPass;
use AdrienBrault\SilexBundle\DependencyInjection\Compiler\FilesReferencePass;
use AdrienBrault\SilexBundle\Silex\Application;
use Symfony\Component\Config\Resource\FileResource;
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

    public function boot()
    {
        $app = new Application($this->container);

        $this->requireFiles(
            $app,
            $this->container->getParameter('silex.files')
        );
    }

    public function requireFiles(Application $app, array $files)
    {
        $routeCollection = $this->container->get('silex.routes');

        foreach ($files as $file) {
            $routeCollection->addResource(new FileResource($file));

            require $file; // require_once does not work with multiple requests with WebTestCase
        }

        $app->flush();
    }
}
