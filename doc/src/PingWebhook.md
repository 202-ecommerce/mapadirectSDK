---
name: 2. Ping
category: Webhooks
---


## Webhook de test d'accessibilité ##


### Description ###


Pour tester la disponibilité de votre webhook order, vous pouvez appeller le webservice ping qui exécutera une requète sur votre webhook afin de vérifier que la clef est correctement configuré et qu'il est bien accessible.

Pour tester au plus proche des conditions d'envoi du webhook order, l'enveloppe d'appel reste la même que order, mais le corps de la requète sera vide.
```
Path: /webhook-mapadirect
Method: POST
Authorization: token a_secret_path_phrase_to_authenticate_the_webhook
```

_Le corps de la requète sera envoyé vide._



L'enveloppe de la réponse doit être établie en json.

HTTP header de réponse (que vous devez retourner) :

| Statut | Message |
| ------ | ------ |
| 200 | Ping valid |
| 400 | Token not valid |
| 50x | Internal Server |


Corps de la réponse :

```application/json
{
    "message": "Ping valid"
}
```

Le message retourné par votre webhook de ping sera transféré et retrouné par le webservice de Ping.


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
