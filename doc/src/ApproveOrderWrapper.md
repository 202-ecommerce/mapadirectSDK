---
name: 2. ApproveOrder
category: Webservices commandes
---


## Enveloppe pour approver une commande suite au dépôts d'une commande ##


### Description ###

Le webservice `ApproveOrder` permet de confirmer la prise en charge de la commande. Cet état correspond à "Commande enregistrée" et/ou "En cours de préparation" chez le marchand.

HTTP header:

```
Path: /orders/{orderId}
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Corps de la requète **automatiquement générée par le SDK** :

```application/json
{
   "approved" : true,
   "do_not_create_invoice" : true
}
```

**NB : Il est inutile de préparer le corps de la requète. Les valeurs par défaut ci-dessus sont imposées par MapaDirect.**

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | Le siret est obligatoire et être un chiffre de 14 caractères. |
| approved | Doit valoir vrai. |
| do_not_create_invoice | Le processus d'achat en marché public impose une création de facture après réception de la marchandise. Doit valoir vrai. |

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |
| 404 | La commande n'existe pas. |


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$orderId = 123;

$wrapper = MDApiClient::getWrapper('ApproveOrder');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($orderId);

$client = new MDApiClient();
try {
    $client->call($wrapper);
} catch (MDApiWrapperValidatorException $e) {
    // Liste des erreurs retournées par le SDK
    $client->getErrors();
    exit;
}

if ($client->getResponse()->isSuccess()) {
    $data = $client->getResponse()->getContent();
} else {
    $data = $client->getResponse()->getContent();
    // Liste des erreurs retournées par l'API
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
