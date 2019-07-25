---
name: 6. UpdateProduct
category: Webservices products
---


## Envelope to update a product ##


### Description ###

The webservice `UpdateProduct` allows to send a product on the MAPAdirect marketplace API.

HTTP header:

```
Path: /products/{productId}
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token `Api Key` of the seller on
the MapaDirect marketplace return by the authentification.

Request's body::

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
            "combination": { },
            "amount": 5,
            "price": 48.4,
            "combination_code": "4006381333933"
        }
    ]
}
```

List of included validators by the SDK

| Fields | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | The siret is mandatory and is a sequence of 14 digits. |
| product_id |The MapaDirect identifier of the product is mandatory and must be a natural number. |
| product | The product title is mandatory. |
| product_code | The product code is mandatory and must be a valid EAN13. |
| infinite_stock | The infinite stock is mandatory and must be a boolean. |
| status | The product status is mandatory and must be one of the following values: A (available) H (hidden) D (disabled). |
| inventory | The inventory table (standard php object) is mandatory and must a table. |
| inventory[0].amount | The quantity in stock must be natural number. |
| inventory[0].price | The price is written as tax-free, is mandatory and must be a decimal number. |
| inventory[0].combination | The combination table is mandatory and must be an array with the company_id field and the main_category value. Example : combination => [12 => 1144]   |
| inventory[0].combination_code | The product code is not mandatory and is a valid EAN13 |``
| green_tax | The eco participation must be included in the HT price (price field) and will be displayed on the order as an indication. This field is mandatory and must be a decimal number |
| tax_ids | The TVA is mandatory and must be indicated as a table having for value the tax ID. Example for TVA 20% : tax_ids => [0 => 5] |
| main_category | The category is mandatory and must be a natural number corresponding to a MapaDirect category. |
| free_shipping | Indicating free shipping for a product is mandatory and must be one of the following values: Y (yes) ou N (No) |

(*) The company_id is the ID returned during the authentication.

The answer's envelope is established in json.

Answer's HTTP header:

| Status | Message |
| ------ | ------ |
| 200 | The product. |
| 404 | The product was not found. |

Answer's body:

```application/json
{
    "product_id": 12345
}
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$inventory = new \stdClass;
$inventory->amount = (int) 123;
$inventory->price = (float) 15.0000;
$inventory->combination = [];

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
    'inventory' => [$inventory]
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
    // List of errors returned by the SDK
    $client->getErrors();
    exit;
}

$data = $client->getResponse()->getContent();
if ($client->getResponse()->isSuccess()) {
    $data = $client->getResponse()->getContent();
} else {
    // Sorry but the API returns an error 500 in case of submission of incorrect data...
    // That's why we have set up a very strict validator in this SDK with every case of known error.
}
```

`$data` returns a php table as described in the answer's body.
