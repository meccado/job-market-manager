# Laravel Job-Market-Manager

[![Latest Version on Packagist](https://poser.pugx.org/meccado/job-market-manager/v/stable)](https://packagist.org/packages/meccado/job-market-manager)
[![Latest Unstable Version](https://poser.pugx.org/meccado/job-market-manager/v/unstable)](https://packagist.org/packages/meccado/job-market-manager)
[![Total Downloads](https://poser.pugx.org/meccado/job-market-manager/downloads)](https://packagist.org/packages/meccado/job-market-manager)


## Install

Via Composer

``` bash
$ composer require meccado/job-market-manager
```
To register the Service Provider edit **config/app.php** file and add to providers array:

```php
 /*
  *  Service Provider
  */
  Meccado\JobMarketManager\JobMarketManagerServiceProvider::class,

```

Publish files with:

```bash

$ php artisan vendor:publish  --force

```

Migrate & Seed database files with:

```bash

$ composer dump-autoload

$ php artisan migrate --seed

```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email tsw603gp@gmail.com instead of using the issue tracker.

## Credits

- [:author_name][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/meccado/job-market-manager.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/meccado/job-market-manager/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/meccado/job-market-manager.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/meccado/job-market-manager.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/meccado/job-market-manager.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/meccado/job-market-manager
[link-travis]: https://travis-ci.org/meccado/job-market-manager
[link-scrutinizer]: https://scrutinizer-ci.com/g/meccado/job-market-manager/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/meccado/job-market-manager
[link-downloads]: https://packagist.org/packages/meccado/job-market-manager
[link-author]: https://github.com/meccado
[link-contributors]: ../../contributors
