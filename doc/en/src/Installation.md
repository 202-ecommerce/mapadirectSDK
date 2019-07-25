---
name: Installation
category: Introduction
---

MapadirectSDK, client PHP for the MAPAdirect marketplace API
=======================

[![Latest Version](https://img.shields.io/github/release/202-ecommerce/mapadirectSDK/all.svg?style=flat-square)](https://github.com/202-ecommerce/mapadirectSDK/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/mapadirectsdk/mapadirectsdk.svg?style=flat-square)](https://packagist.org/packages/mapadirectsdk/mapadirectsdk)
![Requirements](https://img.shields.io/packagist/php-v/mapadirectsdk/mapadirectsdk.svg?style=flat-square)


MapaDirectSDK is a PHP library for connecting your online store to MapaDirect
marketplace.

The library allows you to synchronize your product catalog and receive orders
from the marketplace.

## Documentation

You will find here the [documentation of the MapaDirectSDK library](https://docs.202-ecommerce.com/mapadirectsdk/).

## Install mapadirectsdk


We advise you to install MapaDirectSDK via compose [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Then, run the command Composer to install the latest version of the MapaDirectSDK library:

```bash
php composer.phar require mapadirectsdk/mapadirectsdk
```

After installation you have to call'Composer autoload:

```php
require 'vendor/autoload.php';
```

You can then update the MapaDirectSDK library using composer:

 ```bash
composer.phar update
 ```


## Guide des versions

| Version | Status     | Packagist                     | Namespace           | Repo                           | Doc                            | PSR-7 | PHP Version |
|---------|------------|-------------------------------|---------------------|--------------------------------|--------------------------------|-------|-------------|
| 1.x     | EOL        | `mapadirectsdk/mapadirectsdk` | `MapaDirectSDK`     | [master][mapadirectsdk-1-repo] | [develop][mapadirectsdk-1-doc] | No    | >= 5.6      |

[mapadirectsdk-1-repo]: https://github.com/202-ecommerce/mapadirectSDK
[mapadirectsdk-1-doc]: https://docs.202-ecommerce.com/mapadirectsdk/
