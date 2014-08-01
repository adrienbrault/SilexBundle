<?php

namespace AdrienBrault\SilexBundle\HttpKernel;

use AdrienBrault\SilexBundle\Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;

class ControllerResolver implements ControllerResolverInterface
{
    private $controllerCollection;
    private $wrapped;

    public function __construct(
        ControllerCollection $controllerCollection,
        ControllerResolverInterface $wrapped
    ) {
        $this->controllerCollection = $controllerCollection;
        $this->wrapped = $wrapped;
    }

    /**
     * {@inheritdoc}
     */
    public function getController(Request $request)
    {
        $controller = $request->attributes->get('_controller');

        if (false === strpos($controller, 'silex@')) {
            return $this->wrapped->getController($request);
        }

        $name = substr($controller, strlen('silex@'));

        return $this->controllerCollection->getControllerTo($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getArguments(Request $request, $controller)
    {
        return $this->wrapped->getArguments($request, $controller);
    }
}
