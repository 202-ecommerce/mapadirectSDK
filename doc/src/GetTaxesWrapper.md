---
name: 2. GetTaxes
category: Webservices
---


## Enveloppe pour lister les taxes (TVA) ##


### Description ###

Le webservice `GetTaxes` permet de lister toutes les taxes (TVA) disponible.

Il est nécessaire à l'initialisation de votre catalogue de récupérer les identifiants de taxes
afin de compléter votre catalogue de produits avec les valeurs de taxe correspondant à la fiscalité
de vos produits.

**Nous recommandons très fortement de mettre en place un système permettant de mettre en cache la réponse de ce webservice.**

HTTP header:

```
Path: /taxes
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |

Corps de la réponse :

```application/json
[
    {
        "tax_id": 0,
        "tax": "TVA 20%"
    }
]
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$client = new MDApiClient();
$wrapper = MDApiClient::getWrapper('GetTaxes');
$wrapper->setToken(Configuration::get(Mapadirect::AUTH_TOKEN));
$wrapper->setSiret(Configuration::get(mapadirect::SIRET));
$client->call($wrapper);
$data = $client->getResponse()->getContent();
// mise en cache de $data recommandée
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
