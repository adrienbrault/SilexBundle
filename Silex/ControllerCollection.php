<?php

namespace AdrienBrault\SilexBundle\Silex;

use Silex\ControllerCollection as BaseControllerCollection;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class ControllerCollection extends BaseControllerCollection
{
    /**
     * @var array<name,callable>
     */
    private $controllersTo = array();

    /**
     * {@inheritdoc}
     */
    public function match($pattern, $to)
    {
        $controller = parent::match($pattern, $to);

        $name = 'foo';
        $this->controllersTo['foo'] = $to;
        $controller->getRoute()->setDefault('_controller', 'silex@'.$name);

        return $controller;
    }

    public function getControllerTo($name)
    {
        return $this->controllersTo[$name];
    }
}
