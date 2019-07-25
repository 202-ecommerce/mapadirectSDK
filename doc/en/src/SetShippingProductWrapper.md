---
name: 8. SetShippingProduct
category: Webservices products
---


## Envelope to parameterize the shipping fees per product ##


### Description ###

The webservice SetShippingProduct allows to update the shipping fees associated to a product. It is necessary to plan a distinct call
of`createProduct` or `updateProduct`.

NB : The creation of shippers is directly done on the MAPAdirect marketplace.

HTTP header:

```
Path: /products/{productId}
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token `Api Key` of the seller on the MAPAdirect marketplace returned by the authentication.

The answer's envelope is established in json.

Request's body:

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

List of validators included in the SDK

| Field | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | The siret is mandatory and a sequence of 14 digits. |
| status | The shipping fees' status is mandatory and must be one of the following values: A (active) D (inactive). |
| rates.0.amount |The value amount must be 0 pirce for the first sent article. |
| rates.0.value | The value of the shipping fees for the first article sent must be a decimal number (given in tax free) |
| rates.1.amount | The value amount must cost twice the price of the first sent article. |
| rates.1.value | The value shipping fees from the second sent article must be a decimal number (given in tax free) |

Answer's HTTP header:

| Status | Message |
| ------ | ------ |
| 200 | OK |

Answer's body:

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


The first value of "rates" corresponds to the shipping fees for the purchase
of a product. If a second value is given, the following products will have
shipping fees corresponding to this second value.


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
    // List of errors returned by the SDK
    $client->getErrors();
    exit;
}

if ($client->getResponse()->isSuccess()) {
    $data = $client->getResponse()->getContent();
} else {
    // Sorry but the API returns an error 500...
    // That's why we have set up a very strict validator in this SDK with every case of known error.
}
```

`$data` returns a php table as described in the answer's body.
