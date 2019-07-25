---
name: 2. GetTaxes
category: Webservices products
---


## Envelope to list the taxes (TVA) ##


### Description ###

The webservice `GetTaxes` allows to list all the available taxes (TVA).

It is necessary during the initialization of your catalog to get the taxes ID
to complete your product catalog with the tax value corresponding to the
taxation of your products.

**We strongly recommend to set up a system to cache to reply of this
webservice.**

HTTP header:

```
Path: /taxes
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

Theauthentication is established from the token `Api Key` of the seller on the
MapaDirect returned by the authentication.

List of the validators included in the SDK

| Field | Message |
| ------ | ------ |
| X-SIRET | The siret is mandatory and should by be a sequence of 14 digits. |

Lenvelope of the answer is established in json.

Answer's HTTP header:

| Status | Message |
| ------ | ------ |
| 200 | OK |

Answer's body :

```application/json
[
   {
      "tax_id":2,
      "tax":"TVA 2.1%"
   },
   {
      "tax_id":3,
      "tax":"TVA 5.5%"
   },
   {
      "tax_id":4,
      "tax":"TVA 10%"
   },
   {
      "tax_id":5,
      "tax":"TVA 20%"
   },
   {
      "tax_id":1,
      "tax":"TVA 0%"
   }
]
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$wrapper = MDApiClient::getWrapper('GetTaxes');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);

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
    // recommended caching of $data 
} else {
   // Sorry but the API returns an error 500...
   // That's why we have set up a very strict validator in this SDK with all the known error cases.
}
```

`$data` return a php array as described in the answer body.
