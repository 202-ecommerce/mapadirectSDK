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

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | The product. |
| 404 | The product was not found. |

Corps de la réponse :

```application/json
{

    "product_id": 0,
    "product_code": "4006381333933",
    "product_template_type": "service",
    "infinite_stock": null,
    "supplier_ref": "abcdef",
    "product": "Very comfortable chair.",
    "status": "A",
    "approved": "Y",
    "timestamp": 1500363711,
    "updated_timestamp": 1500364328,
    "company_id": 123,
    "main_category": 456,
    "green_tax": 0.45,
    "condition": "N",
    "geolocation": {},
    "free_features":
    {
        "color": "blue",
        "wifi": true,
        "hdmiPorts": 1
    },
    "free_shipping": "N",
    "weight": 0,
    "is_edp": "N",
    "affiliate_link": "string",
    "attachments": [],
    "main_pair": {},
    "image_pairs": [],
    "full_description": "<p>This is a long product description.</p>",
    "short_description": "<p>This is a short product description.</p>",
    "tax_ids": [
        0
    ],
    "allowed_options_variants":[],
    "inventory":
    [

        {
            "combination": {},
            "amount": 5,
            "price": 48.4,
            "combination_code": "4006381333933"
        }
    ]

}
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$productId = 123;
$product = [
    'product_code' => '1234565410333',
    'product' => 'test2',
    'status' => 'A',
    'green_tax' => 1,
    'price' => 10,
    'amount' => 1,
    'main_category' => 1932,
    'tax_ids' => 1,
    'product_id' => $productId
];

$wrapper = MDApiClient::getWrapper('AddProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($productId);
$wrapper->setInput($product);

$client = new MDApiClient();
$client->call($wrapper);
$data = $client->getResponse()->getContent();
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
