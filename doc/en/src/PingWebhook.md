---
name: 2. Ping
category: Webhooks
---


## Webhook to test accessibility ##


### Description ###


To test the availability of your webhook order, you can call the ping
webservice that will execute a request on your webhook to check that the key
has been well configured and that it is available.

To test as close as possible to the conditions of sending of the webhook order
, the call envelope remains the same as order, but the request's body will be
empty.

```
Path: /webhook-mapadirect
Method: POST
Authorization: token a_secret_path_phrase_to_authenticate_the_webhook
```


_The request's boy will remain empty `{}`._


The answer's envelope must be established in json.

Answer's HTTP header (that you should return) :

| Status | Message |
| ------ | ------ |
| 200 | Ping valid |
| 400 | Token not valid |
| 50x | Internal Server |


Answer's body :

```application/json
{
    "message": "Ping valid"
}
```

The message returned by your ping webhook will be transfered and returned by
the Ping webservice.


### Exemple ###

```php
use MapaDirectSDK\Webhooks\WebhookOrder;
use MapaDirectSDK\Webhooks\WebhookPingException;
use MapaDirectSDK\Webhooks\WebhookErrorException;
use MapaDirectSDK\Webhooks\WebhookRequest;

$wrapper = new WebhookOrder();
$wrapper->setWebHookHash('a_secret_path_phrase_to_authenticate_the_webhook');
$wrapper->setRequest(new WebhookRequest);
try {
    $webhook->process();
} catch (WebhookPingException | WebhookErrorException $e) {
    echo $e->sendResponse();
    exit;
}
```
