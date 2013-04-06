<?php

namespace AdrienBrault\SilexBundle\HttpKernel;

use Silex\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 *
 * Part of the interface from Silex\Application
 */
abstract class Kernel extends BaseKernel
{
    /**
     * Maps a pattern to a callable.
     *
     * You can optionally specify HTTP methods that should be matched.
     *
     * @param string $pattern Matched route pattern
     * @param mixed  $to      Callback that returns the response when matched
     *
     * @return Controller
     */
    public function match($pattern, $to)
    {
        return $this->getControllers()->match($pattern, $to);
    }

    /**
     * Maps a GET request to a callable.
     *
     * @param string $pattern Matched route pattern
     * @param mixed  $to      Callback that returns the response when matched
     *
     * @return Controller
     */
    public function get($pattern, $to)
    {
        return $this->getControllers()->get($pattern, $to);
    }

    /**
     * Maps a POST request to a callable.
     *
     * @param string $pattern Matched route pattern
     * @param mixed  $to      Callback that returns the response when matched
     *
     * @return Controller
     */
    public function post($pattern, $to)
    {
        return $this->getControllers()->post($pattern, $to);
    }

    /**
     * Maps a PUT request to a callable.
     *
     * @param string $pattern Matched route pattern
     * @param mixed  $to      Callback that returns the response when matched
     *
     * @return Controller
     */
    public function put($pattern, $to)
    {
        return $this->getControllers()->put($pattern, $to);
    }

    /**
     * Maps a DELETE request to a callable.
     *
     * @param string $pattern Matched route pattern
     * @param mixed  $to      Callback that returns the response when matched
     *
     * @return Controller
     */
    public function delete($pattern, $to)
    {
        return $this->getControllers()->delete($pattern, $to);
    }

    /**
     * Flushes the controller collection.
     *
     * @param string $prefix The route prefix
     */
    public function flush($prefix = '')
    {
        if (!$this->booted) {
            return;
        }

        $this->getRoutes()->addCollection($this->getControllers()->flush($prefix));
    }

    public function getControllers()
    {
        $this->boot();

        return $this->getContainer()->get('silex.controllers');
    }

    public function getRoutes()
    {
        $this->boot();

        return $this->getContainer()->get('silex.routes');
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->flush();

        return parent::handle($request, $type, $catch);
    }
}
