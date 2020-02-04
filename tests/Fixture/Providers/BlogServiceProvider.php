<?php

namespace Zapheus\Bridge\Silex\Fixture\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Zapheus\Bridge\Silex\Fixture\Controllers\BlogController;

/**
 * Blog Service Provider
 *
 * @package Zapheus
 * @author  Rougin Gutib <rougingutib@gmail.com>
 */
class BlogServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     *
     * @param \Pimple\Container $pimple
     */
    public function register(Container $pimple)
    {
        $blog = new BlogController($pimple['user']);

        $pimple['blog'] = $blog;
    }
}
