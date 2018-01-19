<?php

namespace Zapheus\Bridge\Silex;

use Zapheus\Bridge\Silex\Fixture\Providers\BlogServiceProvider;
use Zapheus\Bridge\Silex\Fixture\Providers\UserServiceProvider;
use Zapheus\Container\Container;
use Zapheus\Provider\Configuration;
use Zapheus\Provider\FrameworkProvider;

/**
 * Provider Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zapheus\Container\WritableInterface
     */
    protected $container;

    /**
     * @var \Zapheus\Provider\FrameworkProvider
     */
    protected $framework;

    /**
     * Sets up the provider instance.
     *
     * @return void
     */
    public function setUp()
    {
        $message = 'Pimple Container is not yet installed.';

        $container = 'Pimple\Container';

        class_exists($container) || $this->markTestSkipped($message);

        $this->container = new Container;

        $class = 'Zapheus\Provider\ConfigurationInterface';

        $config = new Configuration;

        $config->set('silex.user.paths', array());

        $this->container->set($class, $config);

        $this->framework = new FrameworkProvider;
    }

    /**
     * Tests ProviderInterface::register.
     *
     * @return void
     */
    public function testRegisterMethod()
    {
        $providers = array(new UserServiceProvider, new BlogServiceProvider);

        $provider = new Provider($providers);

        $container = $provider->register($this->container);

        $container = $this->framework->register($container);

        $expected = 'Zapheus\Bridge\Silex\Fixture\Controllers\BlogController';

        $result = $container->get('blog');

        $this->assertInstanceOf($expected, $result);
    }
}
