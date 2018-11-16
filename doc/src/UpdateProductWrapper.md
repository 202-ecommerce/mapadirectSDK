---
name: 6. UpdateProduct
category: Webservices produits
---


## Enveloppe pour mettre à jour un produit ##


### Description ###

Le webservice `UpdateProduct` permet d'envoyer un produit sur la marketplace MapaDirect.

HTTP header:

```
Path: /products/{productId}
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Corps de la requète :

```application/json
{
    "product_id": "12345",
    "product": "Very comfortable chair.",
    "product_code": "4006381333933",
    "infinite_stock": null,
    "status": "A",
    "main_category": 456,
    "green_tax": 0.45,
    "free_shipping": "N",
    "tax_ids": [
        "0": 5
    ],
    "inventory": [
        {
            "combination": {
                "12": 1144
            },
            "amount": 5,
            "price": 48.4,
            "combination_code": "4006381333933"
        }
    ]
}
```

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | Le siret est obligatoire et être un chiffre de 14 caractères |
| product_id | L'identifiant MapaDirect du produit est obligatoire et doit être un entier naturel en positif. |
| product | Le titre du produit est obligatoire. |
| product_code | Le code produit est obligatoire et être un EAN13 valide. |
| infinite_stock | Le stock infini est obligatoire et doit être un booléen. |
| status | Le statut du produit est obligatoire et doit être l'une des valeurs suivantes : A (available) H (hidden) D (disabled). |
| inventory | Le tableau d'inventory est obligatoire doit être un tableau. |
| inventory[0].amount | La quantité en stock doit être un entier naturel en positif. |
| inventory[0].price | Le prix s'entend HT, est obligatoire et doit être un nombre décimal. |
| inventory[0].combination | Le tableau de combinaison est obligatoire doit être un tableau ayant pour clef le champs company_id et pour valeur la main_category. Exemple : combination => [12 => 1144] |
| inventory[0].combination_code | Le code produit n'est pas obligatoire et être un EAN13 valide. |``
| green_tax | L'éco participation devra être inclus dans le prix HT (champs price) et sera affiché sur la commande à titre indicatif. Ce champs est obligatoire et doit être un nombre décimal. |
| tax_ids | La TVA est obligatoire et doit être indiquée sous forme de tableau ayant pour valeur l'identifiant de la Taxe. Exemple poru la TAV à 20% : tax_ids => [0 => 5] |
| main_category | La categorie est obligatoire et doit être entier naturel positif correspondant à une categorie MapaDirect. |
| free_shipping | La gratuité des frais de port pour un produit est obligatoire et doit être l'une des valeurs suivantes : Y (yes) ou N (No) |

(*) le company_id est votre identifiant retourné dans lors de l'authentification.

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | The product. |
| 404 | The product was not found. |

Corps de la réponse :

```application/json
{
    "product_id": 12345
}
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$productId = 12345;
$product = [
    'product_id' => $productId
    'product_code' => '1234565410333',
    'product' => 'Very comfortable chair',
    'infinite_stock' => 0,
    'status' => 'A',
    'green_tax' => 0.99,
    'free_shipping' => 'N',
    'main_category' => 1932,
    'tax_ids' => [5],
    'inventory' => [
        'amount' => '123',
        'price' => 15.0000,
        'combination' => [12 => 1244],
        'combination_code' => '1234565410333',
    ]
];

$wrapper = MDApiClient::getWrapper('UpdateProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($productId);
$wrapper->setInput($product);

$client = new MDApiClient();
try {
    $client->call($wrapper);
} catch (MDApiWrapperValidatorException $e) {
    // Liste des erreurs retournées par le SDK
    $client->getErrors();
    exit;
}

$data = $client->getResponse()->getContent();
if ($client->getResponse()->isSuccess()) {
    $data = $client->getResponse()->getContent();
} else {
    // Désolé mais l'API retour une erreur 500...
    // c'est pourquoi nous avons mis en place un validateur très strict dans ce SDK avec tous les cas d'erreur connu.
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
