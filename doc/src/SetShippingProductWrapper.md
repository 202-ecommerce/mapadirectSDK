---
name: 8. SetShippingProduct
category: Webservices produits
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

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | Le siret est obligatoire et être un chiffre de 14 caractères. |
| status | Le statut des frais d'expédition est obligatoire et doit être l'une des valeurs suivantes : A (activé) D (désactivé). |
| rates.0.amount | La valeur amount doit valoir 0 prix pour le premier article envoyé. |
| rates.0.value | La valeur des frais de port pour le premier article envoyé doit être un chiffre décimal et s'entend HT. |
| rates.1.amount | La valeur amount doit valoir 2 prix pour le premier article envoyé. |
| rates.1.value | La valeur des frais de port à partir du deuxième article envoyé doit être un chiffre décimal et s'entend HT. |

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
try {
    $client->call($wrapper);
} catch (MDApiWrapperValidatorException $e) {
    // Liste des erreurs retournées par le SDK
    $client->getErrors();
    exit;
}

if ($client->getResponse()->isSuccess()) {
    $data = $client->getResponse()->getContent();
} else {
    // Désolé mais l'API retour une erreur 500...
    // c'est pourquoi nous avons mis en place un validateur très strict dans ce SDK avec tous les cas d'erreur connu.
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
