<?php

namespace Zapheus\Bridge\Silex;

use Pimple\Container as Pimple;
use Zapheus\Container\ContainerInterface;

/**
 * Container
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Container implements ContainerInterface
{
    /**
     * @var \Pimple\Container
     */
    protected $container;

    /**
     * Initializes the container instance.
     *
     * @param \Pimple\Container $container
     */
    public function __construct(Pimple $container)
    {
        $this->container = $container;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param  string $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->container[$id];
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     *
     * @param  string $id
     * @return boolean
     */
    public function has($id)
    {
        return isset($this->container[$id]);
    }
}
