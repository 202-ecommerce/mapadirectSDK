---
name: 4. AddProduct
category: Webservices products
---


## Envelope to add a product ##


### Description ###

The webservice AddProduct allows to send a product to MAPAdirect marketplace.


HTTP header:


```
Path: /products
Method: POST
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token `Api Key` of the seller on the MapaDirect returned by the authentication.

Request's body :

```application/json
{
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

List of validators included in the SDK

|Field | Message |
|---|--- |
|X-SIRET (sent in header) | the siret is mandatory and must be a sequence of 14 digits |
|product | The product title is mandatory. |
|product_code | The product code is mandatory and must be a valid EAN13. |
|infinite_stock | The infinite stock is mandatory and must be boolean.|
|status | The product status is mandatory and must be one of the following value: A (available) H (hidden) D (disabled).|
|inventory | The array inventory (standard php object) is mandatory and must be an array.|
|inventory[0].amount | The stock quantity must be a natural number.|
|inventory[0].price | The price is written as tax-free, is mandatory and must be a decimal number.|
|inventory[0].combination | The combination table is mandatory and must be an array with the company_id field and the main_category value. Example : combination => [12 => 1144]|
|inventory[0].combination_code | The product code is not mandatory and is a valid EAN13.|
|green_tax | The eco participation must be included in the HT price (price field) and will be displayed on the order as an indication. This field is mandatory and must be a decimal number.|
|tax_ids | The TVA is mandatory and must be indicated as a table having for value the tax ID. Example for TVA 20% : tax_ids => [0 => 5]|
|main_category | The category is mandatory and must be a natural number corresponding to a MapaDirect category.|
|free_shipping | Indicating free shipping for a product is mandatory and must be one of the following values: Y (yes) ou N (No)|
  
NB : product_code corresponds to the product EAN.

Answer's body:

```application/json
{
    "product_id": 12345
}
```

**It is very important to keep the matching between your product ID on your
  website and the ID on mapadirect marketplace.**

### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$inventory = new \stdClass;
$inventory->amount = (int) 123;
$inventory->price = (float) 15.0000;
$inventory->combination = [];

$product = [
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

$wrapper = MDApiClient::getWrapper('AddProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
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
    // Sorry but the API returns an error 500 in case of submission of incorrect data...
    // That's why we have set up a very strict validator in the SDK with all the known error cases.
}
```

`$data` returns a ohp array as described in the answer body.
