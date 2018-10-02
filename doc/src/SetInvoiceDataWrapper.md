---
name: 2. SetInvoiceData
category: Webservices commandes
---


## Enveloppe pour mettre à jour un produit ##


### Description ###

Le webservice `UpdateProduct` permet d'envoyer un produit sur la marketplace MapaDirect.

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

NB : product_code correspond à l'EAN du produit.

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
$client->call($wrapper);
$data = $client->getResponse()->getContent();
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
