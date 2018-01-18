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
    /**
     * @var string
     */
    protected $container = 'Pimple\Container';

    /**
     * @var \Pimple\ServiceProviderInterface
     */
    protected $provider;

    /**
     * Initializes the provider instance.
     *
     * @param \Pimple\ServiceProviderInterface $provider
     */
    public function __construct(ServiceProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Registers the bindings in the container.
     *
     * @param  \Zapheus\Container\WritableInterface $container
     * @return \Zapheus\Container\ContainerInterface
     */
    public function register(WritableInterface $container)
    {
        $pimple = $this->container($container);

        $this->provider->register($pimple);

        return $container->set($this->container, $pimple);
    }

    /**
     * Returns a \Illuminate\Container\Container instance.
     *
     * @param  \Zapheus\Container\WritableInterface $container
     * @return \Illuminate\Container\Container
     */
    protected function container(WritableInterface $container)
    {
        if ($container->has($this->container) === false) {
            $config = $container->get(self::CONFIG);

            $pimple = $this->defaults(new PimpleContainer);

            $silex = $config->get('silex', array(), true);

            foreach ($silex as $key => $value) {
                $exists = isset($pimple[$key]);

                $exists && $pimple[$key] = $value;
            }

            return $pimple;
        }

        return $container->get($this->container);
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
