---
name: 1. Order
category: Webhooks
---


## Order Webhook ##


### Description ###

Your application must have a controller publicly exposed allowing MAPAdirect
to send new orders and order status' updates.


NB : The webhook url is defined during the authentication [see Auth Wrapper](#auth).

The authetication webservice allows to configure the webhook order URL as well
as the token (shared secret) allowing to check that the request comes
mapadirect.

Request's HTTP header (that you will receive) :


```
Path: /webhook-mapadirect
Method: POST
Authorization: token a_secret_path_phrase_to_authenticate_the_webhook
```

Request's body (example) :

```application/json
{
    "id": 123456,
    "taxExclusiveAmount": 121.76,
    "taxInclusiveAmount": 146.11,
    "legalMonetaryTotal": {
        "taxExclusiveAmount": 121.76,
        "taxInclusiveAmount": 146.11,
        "totalTaxAmount": 24.352
    },
    "shippingCostLine": {
        "taxExclusiveAmount": 12.5,
        "taxInclusiveAmount": 15,
        "totalTaxAmount": 2.5,
        "VATRate": 20
    },
    "timestamp": 1532092031,
    "status": "EMITTED",
    "siretNumber": "19781123300010",
    "paymentMethod": "",
    "shippingAddress": {
        "company": "LYCEE DE VILLAROY",
        "contactFullName": "Patricia Jeannot",
        "contactPhone": "0123456789",
        "address": "2 RUE EUGENE RAFFIN",
        "address2": "",
        "city": "GUYANCOURT",
        "zipcode": "78280",
        "country": "FR"
    },
    "billingAddress": {
        "company": "LYCEE DE VILLAROY",
        "contactFullName": "Patricia Jeannot",
        "contactPhone": "0123456789",
        "address": "2 RUE EUGENE RAFFIN",
        "address2": "",
        "city": "GUYANCOURT",
        "zipcode": "78280",
        "country": "FR"
    },
    "items": [
        {
          "name": "Cordon RJ45 catégorie 5e F/UTP jaune - 3 m",
          "quantity": 1,
          "referenceCode": "854106",
          "taxExclusiveAmount": 3.49,
          "taxExclusiveUnitPrice": 3.49,
          "taxInclusiveAmount": 4.19,
          "totalTaxAmount": 0.698,
          "VATRate": 20
        },{
          "name": "Cordon RJ45 catégorie 5e F/UTP vert - 3 m",
          "quantity": 1,
          "referenceCode": "854107",
          "taxExclusiveAmount": 3.49,
          "taxExclusiveUnitPrice": 3.49,
          "taxInclusiveAmount": 4.19,
          "totalTaxAmount": 0.698,
          "VATRate": 20
        }
    ]
}
```


The answer's envelope must be established in json.

Answer's HTTP header (that you must return) :

| Status | Message |
| ------ | ------ |
| 200 | Order valid |
| 400 | The order format is invalid |
| 409 | The order has already been processed |
| 50x | Internal Server |

*Warning* : the redirections 301 or 302 are not followed !

List of command status :

| Status | Comment |
| ------ | ------ |
| SENT | The order submitted by the client and "sent" to the seller on its command's reception webhook . |
| VALIDATED | The order is valid on MapaDirect and in treatment by the seller. |
| SHIPPED | The order has been shipped. (to come) |
| RECEIVED |The client has received the order. |
| EMITTED | The invoice has been generated and La facture a été générée et dematerialiazed |
| TOTALLYPAID | The invoice has been paid (totally). |
| ERROR |  Order rejected, a priori not sent since not handled for the moment |



### Exemple ###

The SDK mapadirect has a class allowing to check the token.

```php
use MapaDirectSDK\Webhooks\WebhookOrder;
use MapaDirectSDK\Webhooks\WebhookPingException;
use MapaDirectSDK\Webhooks\WebhookErrorException;
use MapaDirectSDK\Webhooks\WebhookRequest;

$webhook = new WebhookOrder();
$webhook->setWebHookHash('a_secret_path_phrase_to_authenticate_the_webhook');
$webhook->setRequest(new WebhookRequest);
try {
    $webhook->process();
    $data = $webhook->getData();

    // create or update the order
} catch (\Exception $e) {
    if ($e instanceof WebhookPingException || $e instanceof WebhookErrorException) {
        echo $e->sendResponse();
        exit;
    }
}
```
