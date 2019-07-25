---
name: 7. DeleteProduct
category: Webservices products
---


## Envelope to delete a product ##


### Description ###

The webservice AddProduct allows to send a product on the MAPAdirect
marketplace API.

HTTP header:

```
Path: /products/{productId}
Method: DELETE
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token `Api Key` of the seller onthe MAPAdirect marketplace returned by the authentication.

List of valued included in the SDK

| Field | Message |
| ------ | ------ |
| X-SIRET | The siret is mandatory and must be a sequence of 14 digits |


Answer's HTTP header:

| Status | Message |
| ------ | ------ |
| 200 | Product removed. |
| 400 | Product not found. |



### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$productId = 123;

$wrapper = MDApiClient::getWrapper('DeleteProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($productId);

$client = new MDApiClient();
$client->call($wrapper);
try {
    $client->call($wrapper);
} catch (MDApiWrapperValidatorException $e) {
    // List of errors returned by the SDK
    $client->getErrors();
    exit;
}
// product deleted
if ($client->getResponse()->isSuccess()) {
    // You will not have messages in return
} else {
   // Sorry but the API returns an error 500...
   // That'why we have set up a very strict validator in this SDK with every case of known error.
}
```

`$data` return a php table as described in the answer's body
