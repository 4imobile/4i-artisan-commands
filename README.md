## Laravel 5 4i Artisan Commands

[![Latest Stable Version][ico-version]][link-packagist]
[![Software License][ico-license]][link-licence]
[![Total Downloads][ico-downloads]][link-downloads]

### Description
This package provides some useful Artisan commands for generating everything to do with base project setup and hopefully more in the future.

### Installation

Require this package with Composer using the following command:

```bash
composer require 4mobile/4i-artisan-commands
```

After updating Composer, add the service provider to the `providers` array in `config/app.php`:

```php
FourIMobile\FourIArtisanCommands\CommandServiceProvider::class
```

Run the `dump-autoload` command:
```bash
composer dump-autoload
```

In Laravel, instead of adding the service provider in the `config/app.php` file, you can add the following code to your `app/Providers/AppServiceProvider.php` file, within the `register()` method:

```php
public function register()
{
    if ($this->app->environment() !== 'production') {
        $this->app->register(\FourIMobile\FourIArtisanCommands\CommandServiceProvider::class);
    }
    // ...
}
```

### Commands

Below you can find all the commands that you can use, including the parameters that you can specify.

```
COMMAND                     PARAMETER             DESCRIPTION
-----------------------------------------------------------------------------------------------------------------------
make:device:auth                   -b             Generates a basic auth structure, including everything except OTP
make:device:auth                   -a             Generates the entire auth structure
```

### License
The Laravel Artisan Commands is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-version]: https://poser.pugx.org/4imobile/4i-artisan-commands/v/stable
[ico-license]: https://poser.pugx.org/4imobile/4i-artisan-commands/license
[ico-downloads]: https://poser.pugx.org/4imobile/4i-artisan-commands/downloads

[link-packagist]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-downloads]: https://packagist.org/packages/rhaarhoff/laravel-artisan-commands
[link-licence]: http://opensource.org/licenses/MIT
