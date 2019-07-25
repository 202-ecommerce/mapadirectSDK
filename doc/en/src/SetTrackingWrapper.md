---
name: 3. SetTracking
category: Webservices Orders
---


## Envelope to send the tracking numbers of the shipped packages ##


### Description ###

The webservice `SetTracking` allows to send the tracking number of a command.

HTTP header:

```
Path: /shipments
Method: POST
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token `Api Key` of the seller on
the MAPAdirect marketplace returned for the authentication.

Request's body :

```application/json
{
   "order_id" : "123",
   "comments" : "Colissimo https://sample.com/FDSXXX",
   "trackign_number": "FDSXXX",
   "products": {
        "123456": 3
   }
}
```

List of validators included in the SDK

| Field | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | The siret is mandatory and msut be a sequence of 14 digits. |
| order_id | The order number is mandatory and must be a natural number. |
| comments | Text containing the tracking URL if available. |
| trackign_number | Tracking number. By default, "colis_non_suivi" if non defined. |
| products | Table of shipped products containing [id_produit => quantity] |

NB : If several packages are necessary, it is possible to call several times the webservice with a list of products containing in each package.

The answer's envelope is established in json.

Answer's HTTP header :

| Status | Message |
| ------ | ------ |
| 200 | OK |
| 400 | One of the request's attributes is wrong. |


Answer's body :

```application/json
{
    "shipment_id":122
}
```

A priori, this data can be not kept except as log usage.


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$orderId = 123;
$tracking = [
   "comments" => "Colissimo https://tracking.colissimo.com/FDSXXX",
   "trackign_number" => "FDSXXX",
   "products" => [
        "123456" => 3
   ]
];

$wrapper = MDApiClient::getWrapper('SetTracking');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($orderId);
$wrapper->setInput($tracking);

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
    $data = $client->getResponse()->getContent();
    // List of errors returned by the API 
}
```

NB : To respect the nomenclature of the call of the MAPAdirect webservices,
the SDK allows to enter the order id `order_id` by defining it by setId which
will complete the request'

`$data` returns a php table as described in the answer's body.
