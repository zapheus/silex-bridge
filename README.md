# Silex Service Provider Bridge

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Converts [Silex Service Providers](https://silex.symfony.com/doc/2.0/providers.html#service-providers) to [Zapheus](https://github.com/zapheus/zapheus) providers.

## Installation

Install `Silex Bridge` via [Composer](https://getcomposer.org/):

``` bash
$ composer require zapheus/silex-bridge
```

## Basic Usage

``` php
use Acme\Providers\AuthServiceProvider;
use Acme\Providers\RoleServiceProvider;
use Zapheus\Bridge\Silex\BridgeProvider;
use Zapheus\Container\Container;

$providers = array(new AuthServiceProvider, new RoleServiceProvider);

$provider = new BridgeProvider((array) $providers);

$container = $provider->register(new Container);

$pimple = $container->get(BridgeProvider::CONTAINER);
```

## Changelog

Please see [CHANGELOG][link-changelog] for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Credits

- [All contributors][link-contributors]

## License

The MIT License (MIT). Please see [LICENSE][link-license] for more information.

[ico-code-quality]: https://img.shields.io/scrutinizer/g/zapheus/silex-bridge.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/zapheus/silex-bridge.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/zapheus/silex-bridge.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/zapheus/silex-bridge/master.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/zapheus/silex-bridge.svg?style=flat-square

[link-changelog]: https://github.com/zapheus/silex-bridge/blob/master/CHANGELOG.md
[link-code-quality]: https://scrutinizer-ci.com/g/zapheus/silex-bridge
[link-contributors]: https://github.com/zapheus/silex-bridge/contributors
[link-downloads]: https://packagist.org/packages/zapheus/silex-bridge
[link-license]: https://github.com/zapheus/silex-bridge/blob/master/LICENSE.md
[link-packagist]: https://packagist.org/packages/zapheus/silex-bridge
[link-scrutinizer]: https://scrutinizer-ci.com/g/zapheus/silex-bridge/code-structure
[link-travis]: https://travis-ci.org/zapheus/silex-bridge