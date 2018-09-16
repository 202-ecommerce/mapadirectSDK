---
name: 4. AddProduct
category: Webservices
---


## Enveloppe pour ajouter un produit ##


### Description ###

Le webservice AddProduct permet d'envoyer un produit sur la marketplace mapadirect.


HTTP header:


```
Path: /products
Method: POST
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Corps de la requète :

```application/json
{
    "product_code": "4006381333933",
    "product_template_type": "service",
    "infinite_stock": null,
    "supplier_ref": "abcdef",
    "product": "Very comfortable chair.",
    "status": "A",
    "main_category": 456,
    "green_tax": 0.45,
    "condition": "N",
    "free_shipping": "N",
    "weight": 0,
    "is_edp": "N",
    "affiliate_link": "string",
    "main_pair":
    {
        "detailed": {}
    },
    "image_pairs":
    [
        {}
    ],
    "full_description": "<p>This is a long product description.</p>",
    "short_description": "<p>This is a short product description.</p>",
    "tax_ids":
    [
        0
    ],
    "inventory":
    [
        {
            "combination":
            {
                "123": 456,
                "789": 101
            },
            "amount": 5,
            "price": 48.4,
            "combination_code": "4006381333933"
        }
    ]
}
```

NB : product_code correspond à l'EAN du produit.

Corps de la réponse :

```application/json
{
    "product_id": 123
}
```

**Il est très important de conserver une correspondance entre l'identifiant de vos produits sur votre site marchand et
l'identifiant sur la marketplace mapadirect.**

### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$product = [
    'product_code' => '1234565410333',
    'product' => 'Very comfortable chair',
    'status' => 'A',
    'green_tax' => 0,
    'price' => 15,
    'amount' => 1,
    'main_category' => 1932,
    'tax_ids' => [1],
];

$wrapper = MDApiClient::getWrapper('AddProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setInput($product);

$client = new MDApiClient();
$client->call($wrapper);
$data = $client->getResponse()->getContent();
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
