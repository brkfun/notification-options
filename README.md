# Laravel Notification Settings Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/brkfun/notification-options.svg?style=flat-square)](https://packagist.org/packages/brkfun/notification-options)
[![Build Status](https://img.shields.io/travis/brkfun/notification-options/master.svg?style=flat-square)](https://travis-ci.org/brkfun/notification-options)
[![Quality Score](https://img.shields.io/scrutinizer/g/brkfun/notification-options.svg?style=flat-square)](https://scrutinizer-ci.com/g/brkfun/notification-options)
[![Total Downloads](https://img.shields.io/packagist/dt/brkfun/notification-options.svg?style=flat-square)](https://packagist.org/packages/brkfun/notification-options)



## Installation

You can install the package via composer:

```bash
composer require brkfun/notification-options
```

You can also drop the config and needed files :

```bash
php artisan vendor:publish Brkfun/NotificationOptions
```



## Usage

Go to your notifiable model and add a trait

``` php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use BRKFun\NotificationOptions\Traits\HasNotificationOptions;

class User extends Authenticatable 
{
use HasNotificationOptions;
}
```

Whenever you call anything starts with wants ie.

``` php
$user = User::first();
return $user->wantsMailNotification;
```

it will turn you the setting for user.
If there isn't any settings in for user,
it will create a new setting value to database

##Todo List
#####1. create a router and methods for subscribe and unsubscribe stuff. 
#####2. create facade for faster usage. 

### Testing

No testing developed yet.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues just drop an issue.

## Credits

- [Burak Faruk SAHIN](https://github.com/brkfun)
- [All Contributors](../../contributors)

## License

The The Unlicense. Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
