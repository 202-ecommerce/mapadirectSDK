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

Corps de la requète (exemple) :

```application/json
{
  "address": {
    "city": "GUYANCOURT",
    "lines": [
      "2 RUE EUGENE RAFFIN",
      "PLACEHOLDER_EMPTYSTRING"
    ],
    "postalCode": "78280"
  },
  "commitment": {
    "commitmentDate": "2018-06-22",
    "commitmentNumber": "18 - 144 / 016G"
  },
  "currency": "EUR",
  "customer": {
    "address": {
      "city": "GUYANCOURT",
      "lines": [
        "2 RUE EUGENE RAFFIN",
        "PLACEHOLDER_EMPTYSTRING"
      ],
      "postalCode": "78280"
    },
    "contact": {
      "email": "exemple@mapadirect.fr",
      "name": "Patricia Jeannot",
      "telephone": "0139306460"
    },
    "identification": {
      "id": "19781123300010",
      "idType": "SIRET"
    },
    "legalEntity": {
      "intraCommunityVATNumber": "FRXXX",
      "registrationAddress": {
        "city": "GUYANCOURT",
        "lines": [
          "2 RUE EUGENE RAFFIN",
          "PLACEHOLDER_EMPTYSTRING"
        ],
        "postalCode": "78280"
      },
      "registrationName": "LYCEE DE VILLAROY"
    }
  },
  "delivery": {
    "deliveryLocation": {
      "address": {
        "city": "GUYANCOURT",
        "lines": [
          "2 RUE EUGENE RAFFIN",
          "PLACEHOLDER_EMPTYSTRING"
        ],
        "postalCode": "78280"
      },
      "siteName": "PLACEHOLDER_EMPTYSTRING"
    }
  },
  "formLinkUuid": "PROCESSED",
  "invoiceDate": "2018-07-20",
  "invoiceNumber": "F180715190",
  "issueDate": "2018-07-13",
  "legalMonetaryTotal": {
    "note": [
      "PLACEHOLDER_EMPTYSTRING"
    ],
    "taxExclusiveAmount": 121.76,
    "taxInclusiveAmount": 146.11,
    "totalTaxAmount": 24.352
  },
  "orderIdentifier": "1",
  "productLines": [
    {
      "commission": {
        "flatRateAmount": 0,
        "rate": 0.1
      },
      "name": "Cordon RJ45 catégorie 5e F/UTP jaune - 3 m",
      "quantity": 1,
      "referenceCode": "854106",
      "taxExclusiveAmount": 3.49,
      "taxExclusiveUnitPrice": 3.49,
      "taxInclusiveAmount": 4.19,
      "totalTaxAmount": 0.698,
      "VATRate": 20
    },
    {
      "commission": {
        "flatRateAmount": 0,
        "rate": 0.1
      },
      "name": "Cordon RJ45 catégorie 5e F/UTP violet - 0,5 m",
      "quantity": 5,
      "referenceCode": "847168",
      "taxExclusiveAmount": 14.95,
      "taxExclusiveUnitPrice": 2.99,
      "taxInclusiveAmount": 17.94,
      "totalTaxAmount": 2.99,
      "VATRate": 20
    },
    {
      "commission": {
        "flatRateAmount": 0,
        "rate": 0.1
      },
      "name": "Cordon RJ45 catégorie 5e F/UTP rose - 1 m",
      "quantity": 5,
      "referenceCode": "847157",
      "taxExclusiveAmount": 17.45,
      "taxExclusiveUnitPrice": 3.49,
      "taxInclusiveAmount": 20.94,
      "totalTaxAmount": 3.49,
      "VATRate": 20
    },
    {
      "commission": {
        "flatRateAmount": 0,
        "rate": 0.1
      },
      "name": "Cordon RJ45 catégorie 5e F/UTP vert - 2 m",
      "quantity": 2,
      "referenceCode": "854115",
      "taxExclusiveAmount": 6.38,
      "taxExclusiveUnitPrice": 3.19,
      "taxInclusiveAmount": 7.66,
      "totalTaxAmount": 1.276,
      "VATRate": 20
    },
    {
      "commission": {
        "flatRateAmount": 0,
        "rate": 0.1
      },
      "name": "Cordon RJ45 catégorie 5e F/UTP rouge - 2 m",
      "quantity": 21,
      "referenceCode": "854135",
      "taxExclusiveAmount": 66.99,
      "taxExclusiveUnitPrice": 3.19,
      "taxInclusiveAmount": 80.39,
      "totalTaxAmount": 13.398,
      "VATRate": 20
    }
  ],
  "shippingCostLine": {
    "taxExclusiveAmount": 12.5,
    "taxInclusiveAmount": 15,
    "totalTaxAmount": 2.5,
    "VATRate": 20
  },
  "status": "EMITTED",
  "supplier": {
    "bankAccount": {
      "BIC": "CMCIFR2A",
      "IBAN": "FR7610278060860003209123456"
    },
    "commercialAddress": {
      "city": "SAINT GERMAIN EN LAYE",
      "lines": [
        "21 AV SAINT FIACRE"
      ],
      "postalCode": "78100"
    },
    "contact": {
      "email": "marchand@domain.com",
      "name": "Matthieu Marchand",
      "telephone": "0123456789"
    },
    "identification": {
      "id": "42410985000021",
      "idType": "SIRET"
    },
    "legalEntity": {
      "intraCommunityVATNumber": "FR66499996450",
      "registrationAddress": {
        "city": "SAINT GERMAIN EN LAYE",
        "lines": [
          "21 AV SAINT FIACRE"
        ],
        "postalCode": "78100"
      },
      "registrationName": "MARCHAND SUPER"
    },
    "legalNotices": []
  },
  "taxTotals": [
    {
      "rate": 20,
      "taxAmount": 24.352,
      "taxExclusiveAmount": 121.76
    }
  ],
  "timestamp": 1532092031
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

$webhook = new WebhookOrder();
$webhook->setWebHookHash('a_secret_path_phrase_to_authenticate_the_webhook');
$webhook->setRequest(new WebhookRequest);
try {
    $webhook->process();
    $data = $webhook->getData();

    // create or update the order
} catch (\Exception $e) {
    if ($e instanceof WebhookPingException || $e WebhookErrorException BError) {
        echo $e->sendResponse();
        exit;
    }
}
```
