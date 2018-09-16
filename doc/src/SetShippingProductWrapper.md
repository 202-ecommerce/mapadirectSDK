---
name: 8. SetShippingProduct
category: Webservices
---


## Enveloppe de paramètrage des frais de port par produit ##


### Description ###

Le webservice SetShippingProduct permet de mettre à jour les frais de port associé à un produit.
Il est nécessaire de prévoir un appel distinct de `createProduct` ou `updateProduct`.

NB : La création des transporteurs se fait directement sur la marketplace MapaDirect.

HTTP header:

```
Path: /products/{productId}
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

L'enveloppe de la réponse est établie en json.

Corps de la requète :

```application/json
{
    "status": "A",
    "rates":
    [
        {
            "amount": 0,
            "value": 3.99

        },
        {
            "amount": 1,
            "value": 1.99
        }
    ]
}
```

Statuts des frais d'expédition :
* A: frais d'expédition activé
* D: frais d'expédition désactivé

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |

Corps de la réponse :

```application/json
{
  "shipping_id": 0,
  "status": "A",
  "shipping": "TNT Express",
  "delivery_time": "24h",
  "rates": [
    {
      "amount": 0,
      "value": 3.99
    },
    {
      "amount": 1,
      "value": 1.99
    }
  ],
  "description": "<p>TNT shipping without tracking.</p>"
}
```


La première valeur de "rates" correspond au frais de port pour l'achat d'un produit. Si une deuxième valeur est saisie,
les produits suivant se verront appliqué les frais avec cette deuxième valeur.


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$productId = 123;
$productShipping = [
    "status": "A",
    "rates" => [
        [
            "amount": 0,
            "value": 3.99

        ],[
            "amount": 1,
            "value": 1.99
        ]
    ]
];

$wrapper = MDApiClient::getWrapper('SetShippingProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($productId);
$wrapper->setInput($productShipping);

$client = new MDApiClient();
$client->call($wrapper);
$data = $client->getResponse()->getContent();
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
