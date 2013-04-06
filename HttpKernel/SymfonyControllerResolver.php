<?php

namespace AdrienBrault\SilexBundle\HttpKernel;

use AdrienBrault\SilexBundle\Silex\ControllerCollection;
use Symfony\Bundle\FrameworkBundle\Controller\ControllerResolver as BaseControllerResolver;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class SymfonyControllerResolver extends BaseControllerResolver
{
    private $controllerCollection;

    public function setControllerCollection(ControllerCollection $controllerCollection)
    {
        $this->controllerCollection = $controllerCollection;
    }

    public function getController(Request $request)
    {
        $controller = $request->attributes->get('_controller');

        if (false === strpos($controller, 'silex@')) {
            return parent::getController($request);
        }

        $name = substr($controller, strlen('silex@'));
        return $this->controllerCollection->getControllerTo($name);
    }
}
