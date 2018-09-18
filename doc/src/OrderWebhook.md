---
name: Order
category: Webhooks
---


## Order Webhook ##


### Description ###

Votre application doit disposer d'un controller exposé publiquement permettant à Mapadirect de vous
envoyer les nouvelles commandes et les mises à jour des statuts des commandes.

NB : L'url du webhook est définie lors de l'authentification [voir Auth Wrapper](#auth).

Le webservice d'authentification permet de configurer l'URL du webhook order ainsi que le jeton (secret partagé) permettant de vérifier que la requète provient de mapadirect.

HTTP header de la requète (que vous receverez) :

```
Path: /webhook-mapadirect
Method: POST
Authorization: token a_secret_path_phrase_to_authenticate_the_webhook
```

Corps de la requète :

```application/json
{
    {
        "id": "string",
        "siretNumber": "string",
        "total": 123.45,
        "subtotal": 123.45,
        "timestamp": 1.5,
        "status": "SENT",
        "shippingAddress": {
        "contactFullName": "string",
        "company": "string",
        "address": "string",
        "address2": "string",
        "city": "string",
        "zipcode": "string",
        "country": "FR",
        "contactPhone": "+33123456789"
    },
    "items": [
        {
        "productName": "string",
        "productCode": "string",
        "price": 100,
        "amount": 1
        }
    ],
    "paymentMethod": "string"
}
```

L'enveloppe de la réponse doit être établie en json.

HTTP header de réponse (que vous devez retourner) :

| Statut | Message |
| ------ | ------ |
| 201 | Order valid |
| 400 | The order format is invalid |
| 409 | The order has already been processed |
| 50x | Internal Server |

Liste des status de commande :

| Statut | Commentaire |
| ------ | ------ |
| VALIDATED | La commande est valide sur MapaDirect et cours de traitement par le marchand. |
| SENT | Le marchand a expédié la commande. |
| RECEIVED | Le client a reçu la commande. |
| EMITTED | La facture a été générée et dématérialisée. |
| TOTALLYPAID | La facture a été payée (entièrement). |
| ERROR | Commande rejetée, a priori non envoyé car non géré pour l'instant |


### Exemple ###

Le SDK mapadirect dispose d'une classe permettant de vérifier le jeton.

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
    $data = $webhook->getData();

    // create or update the order
} catch (WebhookPingException | WebhookErrorException $e) {
    echo $e->sendResponse();
    exit;
}
```
