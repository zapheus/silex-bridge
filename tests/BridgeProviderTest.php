<?php

namespace Zapheus\Bridge\Silex;

use Zapheus\Bridge\Silex\Fixture\Providers\BlogServiceProvider;
use Zapheus\Bridge\Silex\Fixture\Providers\UserServiceProvider;
use Zapheus\Container\Container;
use Zapheus\Provider\Configuration;

/**
 * Bridge Provider Test
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class BridgeProviderTest extends \PHPUnit_Framework_TestCase
{
    const BLOG_CONTROLLER = 'Zapheus\Bridge\Silex\Fixture\Controllers\BlogController';

    /**
     * @var \Zapheus\Container\WritableInterface
     */
    protected $container;

    /**
     * Sets up the provider instance.
     *
     * @return void
     */
    public function setUp()
    {
        $data = array('silex' => array('user' => array()));

        $data['silex']['user']['paths'] = array();

        $config = new Configuration((array) $data);

        $instances = array(BridgeProvider::CONFIG => $config);

        $this->container = new Container($instances);
    }

    /**
     * Tests ProviderInterface::register.
     *
     * @return void
     */
    public function testRegisterMethod()
    {
        $providers = array(new UserServiceProvider, new BlogServiceProvider);

        $provider = new BridgeProvider((array) $providers);

        $container = $provider->register($this->container);

        $container = $container->get(BridgeProvider::CONTAINER);

        $expected = (string) self::BLOG_CONTROLLER;

        $result = $container['blog'];

        $this->assertInstanceOf($expected, $result);
    }
}
