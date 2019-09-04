---
name: 1. Order
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

Corps de la requète (exemple) :

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
    "serviceCode": "",
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

L'enveloppe de la réponse doit être établie en json.

HTTP header de réponse (que vous devez retourner) :

| Statut | Message |
| ------ | ------ |
| 200 | Order valid |
| 400 | The order format is invalid |
| 409 | The order has already been processed |
| 50x | Internal Server |

*Attention* : les redirections 301 ou 302 ne sont pas suivies !

Liste des status de commande :

| Statut | Commentaire |
| ------ | ------ |
| SENT | La commande est soumise par le client et "envoyée" au marchand sur son webhook de réception de commande. |
| VALIDATED | La commande est valide sur MapaDirect et cours de traitement par le marchand. |
| SHIPPED | La commande est expédié. (à venir) |
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
