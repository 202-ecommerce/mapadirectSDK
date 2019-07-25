---
name: 4. SetInvoiceData
category: Webservices Orders
---


## Envelope to send invoice number and date ##


### Description ###


The webservice `SetInvoiceData` allows to send the invoice information of the seller to MAPAdirect.

HTTP header:

```
Path: /orders/{orderId}/setinvoicedata
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```


The authentication is established from the token `Api Key` of the seller on
the MapaDirect marketplace returned by the authentication.

Request's body:

```application/json
{
   "invoiceNumber" : "F132465",
   "invoiceDate" : "2018-06-07T17:56:00.000Z"
}
```

List of validators included in the SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) |The siret is mandatory and must be a sequence of 14 digits. |
| invoiceNumber | The invoice number is mandatory and must be composed of at least one digit. |
| invoiceDate | The invoice date is mandatory and must be under ISO 8601 format. |

The answer's envelope is established in json.

Answer's HTTP header :

| Status | Message |
| ------ | ------ |
| 200 | OK |
| 400 | One of the request's attributes is missing or the invoiceDate is not fitting the JSON format |
| 403 | Case where the user calling is not the seller declared on the order.  |
| 404 | The order doesn't exist. |


Answer's body :

```application/json
{
    "securitizationUrl": "test"
}
```


SecuritizationUrl is not present if the seller has chosen to be paid by URICA.
securitizationUrl is the URL allowing the seller to validate the repurchase of its invoice by URICA.

*Note : the interfacing with URICA is under development.*

The attribute securitizationUrl will not valorized with « test » until our
work terminates.

### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$orderId = 123;
$invoice = [
   invoiceNumber : "F132465",
   invoiceDate : "2018-06-07T17:56:00.000Z"
];

$wrapper = MDApiClient::getWrapper('SetInvoiceData');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($orderId);
$wrapper->setInput($invoice);

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

`$data` returns a php table as described in the answer's body.
