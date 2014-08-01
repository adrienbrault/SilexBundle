<?php

namespace AdrienBrault\SilexBundle\Silex;

use Silex\Application as BaseApplication;
use Silex\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Application extends BaseApplication
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function register(ServiceProviderInterface $provider, array $values = array())
    {
        throw new \BadMethodCallException();
    }

    public function boot()
    {
        throw new \BadMethodCallException();
    }

    public function run(Request $request = null)
    {
        throw new \BadMethodCallException();
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        throw new \BadMethodCallException();
    }

    public function terminate(Request $request, Response $response)
    {
        throw new \BadMethodCallException();
    }

    public function offsetExists($offset)
    {
        return $this->container->has($offset) || $this->container->hasParameter($offset);
    }

    public function offsetGet($offset)
    {
        $aliases = [
            'controllers' => 'silex.controllers',
            'routes' => 'silex.routes',
            'dispatcher' => 'event_dispatcher',
            'locale' => 'kernel.default_locale',
            'charset' => 'kernel.charset',
        ];
        if (isset($aliases[$offset])) {
            $offset = $aliases[$offset];
        }

        return $this->container->has($offset)
            ? $this->container->get($offset)
            : $this->container->getParameter($offset)
        ;
    }

    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException();
    }

    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException();
    }
}
