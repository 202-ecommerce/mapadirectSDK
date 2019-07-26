MapadirectSDK, client PHP pour l'API de la marketplace Mapadirect
=======================

[![Latest Version](https://img.shields.io/github/release/202-ecommerce/mapadirectSDK/all.svg?style=flat-square)](https://github.com/202-ecommerce/mapadirectSDK/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/mapadirectsdk/mapadirectsdk.svg?style=flat-square)](https://packagist.org/packages/mapadirectsdk/mapadirectsdk)
![Requirements](https://img.shields.io/packagist/php-v/mapadirectsdk/mapadirectsdk.svg?style=flat-square)


MapaDirectSDK est une librairie PHP permettant de connecter votre site marchand à la
marketplace MapaDirect.

La librairie permert de synchroniser son catalogue de produits et recevoir les commandes prises sur la marketplace.

## Documentation

Vous trouverez ici la [documentation de la librairie MapaDirectSDK](https://docs.202-ecommerce.com/mapadirectsdk/fr/). [(Version EN)](https://docs.202-ecommerce.com/mapadirectsdk/en/)

## Installer mapadirectsdk

Nous recommandons d'installer MapaDirectSDK via composer [Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Ensuite, lancer la commande Composer command pour installer la dernière version de la librairie MapaDirectSDK:

```bash
php composer.phar require mapadirectsdk/mapadirectsdk
```

Après installation vous devez appeler l'autoload de Composer :

```php
require 'vendor/autoload.php';
```

Vous pourrez ensuite mettre à jour la librairie MapaDirectSDK en utilisant composer:

 ```bash
composer.phar update
 ```


## Guide des versions

| Version | Status     | Packagist           | Namespace    | Repo                | Doc                | PSR-7 | PHP Version |
|---------|------------|---------------------|--------------|---------------------|---------------------|-------|-------------|
| dev-master     | EOL        | `mapadirectsdk/mapadirectsdk`     | `MapaDirectSDK`     | [master][mapadirectsdk-1-repo] | [EN][mapadirectsdk-1-doc-en]/[FR][mapadirectsdk-1-doc-fr] | No    | >= 5.6    |

[mapadirectsdk-1-repo]: https://github.com/202-ecommerce/mapadirectSDK
[mapadirectsdk-1-doc-fr]: https://docs.202-ecommerce.com/mapadirectsdk/fr/
[mapadirectsdk-1-doc-en]: https://docs.202-ecommerce.com/mapadirectsdk/en/