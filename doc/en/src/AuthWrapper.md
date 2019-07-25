---
name: 1. Auth
category: Webservices products
---


## Envelope to'authenticate to the'API ##


### Description ###

The authentication webservice 'authentication allows to return the API key'API which will then have to be used by all the others webservices to authenticate the seller on 'MapaDirect API.

A call to this webservice is essential for the first utilisation of the MapaDirect API.

You should specify the webhook URL and the security hash (shared secret with MapaDirect).
If you later need to change the url or the webhook hash, vous will need to renew the call to authentication.

HTTP header:

```
Path: /users/authenticate
Method: GET
Authorization: Basic authentication
X-SIRET: Siret_du_marchand
X-WEBHOOKURL: https://you-shop-domain.tld/webhook-mapadirect
X-WEBHOOKHASH: a_secret_path_phrase_to_authenticate_the_webhook
```

The authentication is established from the seller ID / password on MapaDirect marketplace.

List of validators included in the SDK

|Field | Message|
|---|---|
|X-SIRET | The siret is mandatory and is a sequence of 14 digits|
|X-WEBHOOKURL | The webhook URL must be valid in the sense of the filter PHP [FILTER_VALIDATE_URL](http://php.net/manual/en/filter.filters.validate.php)|
|X-WEBHOOKHASH | The webhook hash is mandatory and must be a string of length 88.|
  
The envelope of the answer is established in json.

Answer's HTTP header :

| Status | Message |
| ------ | ------ |
| 200 | OK |
| 401 | Erreur |

Error messages :

* Unknown SIRET number
* Unauthorized
* ...

### Exemple ###

```php
use MapaDirectSDK\MDApiClient

$wrapper = MDApiClient::getWrapper('Auth');
$wrapper->setCredentials('you.marchand.email@domain.tld:password');
$wrapper->setSiret('20220220220220');
$wrapper->setWebHookUrl('https://you-shop-domain.tld/module/mapadirect/ordersSync');
$wrapper->setWebHookHash('488e7cafd8fc88f386ba2a88574a7f35');

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
    $apiKey = $data['apiKey'];
    // store API_key somewhere like in a database
} else {
    // List of errors returned by the MAPAdirect marketplace API
    $error = $data['message'];
}

```
