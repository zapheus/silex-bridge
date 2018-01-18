<?php

namespace Zapheus\Bridge\Silex;

use Pimple\Container as PimpleContainer;
use Zapheus\Bridge\Silex\Fixture\Controllers\UserController;

/**
 * Container Test
 *
 * @package Zapheus
 * @author  Rougin Royce Gutib <rougingutib@gmail.com>
 */
class ContainerTest extends \PHPUnit_Framework_TestCase
{
    const FOOD_CONTROLLER = 'Zapheus\Bridge\Silex\Fixture\Controllers\UserController';

    /**
     * @var \Zapheus\Container\ContainerInterface
     */
    protected $container;

    /**
     * Sets up the container instance.
     */
    public function setUp()
    {
        $container = new PimpleContainer;

        $container['user'] = new UserController;

        $this->container = new Container($container);
    }

    /**
     * Tests ContainerInterface::get.
     *
     * @return void
     */
    public function testGetMethod()
    {
        $expected = get_class(new UserController);

        $result = $this->container->get('user');

        $this->assertInstanceOf($expected, $result);
    }

    /**
     * Tests ContainerInterface::has.
     *
     * @return void
     */
    public function testHasMethod()
    {
        $this->assertTrue($this->container->has('user'));
    }
}
