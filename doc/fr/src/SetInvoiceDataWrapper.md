---
name: 4. SetInvoiceData
category: Webservices commandes
---


## Enveloppe pour envoyer les numéro et date de facture ##


### Description ###

Le webservice `SetInvoiceData` permet d'envoyer les informations de facturation du marchand à MapaDirect.

HTTP header:

```
Path: /orders/{orderId}/setinvoicedata
Method: PUT
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Corps de la requète :

```application/json
{
   "invoiceNumber" : "F132465",
   "invoiceDate" : "2018-06-07T17:56:00.000Z"
}
```

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | Le siret est obligatoire et être un chiffre de 14 caractères. |
| invoiceNumber | Le numéro de facture est obligatoire et disposer d'au moins un chiffre. |
| invoiceDate | Le date de la facture est obligatoire être au format ISO 8601. |

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |
| 400 | Un des attributs de la requête est manquant ou invoiceDate n'est pas au format JSON. |
| 403 | Cas où l'utilisateur appelant n'est pas le marchand déclaré sur la commande. |
| 404 | La commande n'existe pas. |


Corps de la réponse :

```application/json
{
    "securitizationUrl": "test"
}
```

SecuritizationUrl n'est présent que si le marchand a choisi de se faire payer par URICA.
securitizationUrl est l'URL permettant au marchand de valider le rachat de facture par URICA.

*Note : l'interfaçage avec URICA est en développement.*

L'attribut securitizationUrl sera donc valorisé avec « test » jusqu'à ce que nos travaux aboutissent.

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
