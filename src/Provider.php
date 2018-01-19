<?php

namespace Zapheus\Bridge\Silex;

use Pimple\Container as PimpleContainer;
use Pimple\ServiceProviderInterface;
use Zapheus\Container\WritableInterface;
use Zapheus\Provider\ProviderInterface;

/**
 * Provider
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class Provider implements ProviderInterface
{
    const CONTAINER = 'Pimple\Container';

    /**
     * @var \Pimple\ServiceProviderInterface[]
     */
    protected $providers;

    /**
     * Initializes the provider instance.
     *
     * @param \Pimple\ServiceProviderInterface[] $providers
     */
    public function __construct($providers)
    {
        $this->providers = $providers;
    }

    /**
     * Registers the bindings in the container.
     *
     * @param  \Zapheus\Container\WritableInterface $container
     * @return \Zapheus\Container\ContainerInterface
     */
    public function register(WritableInterface $container)
    {
        $config = $container->get(self::CONFIG);

        $pimple = $this->defaults(new PimpleContainer);

        $silex = $config->get('silex', array(), true);

        foreach ($silex as $key => $value) {
            $exists = isset($pimple[$key]);

            $exists && $pimple[$key] = $value;
        }

        foreach ($this->providers as $provider) {
            $provider->register($pimple);
        }

        return $container->set(self::CONTAINER, $pimple);
    }

    /**
     * Returns a Pimple container with default parameters.
     *
     * @param  \Pimple\Container $pimple
     * @return \Pimple\Container
     */
    protected function defaults(PimpleContainer $pimple)
    {
        $pimple['request.http_port'] = 80;

        $pimple['request.https_port'] = 443;

        $pimple['debug'] = false;

        $pimple['charset'] = 'UTF-8';

        $pimple['logger'] = null;

        return $pimple;
    }
}
