---
name: 7. DeleteProduct
category: Webservices produits
---


## Enveloppe pour supprimer un produit ##


### Description ###

Le webservice AddProduct permet d'envoyer un produit sur la marketplace mapadirect.

HTTP header:

```
Path: /products/{productId}
Method: DELETE
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET | Le siret est obligatoire et être un chiffre de 14 caractères |


HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | Product removed. |
| 400 | Product not found. |



### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$productId = 123;

$wrapper = MDApiClient::getWrapper('DeleteProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($productId);

$client = new MDApiClient();
$client->call($wrapper);
try {
    $client->call($wrapper);
} catch (MDApiWrapperValidatorException $e) {
    // Liste des erreurs retournées par le SDK
    $client->getErrors();
    exit;
}
// product deleted
if ($client->getResponse()->isSuccess()) {
    // vous n'aurez pas de message en retour
} else {
    // Désolé mais l'API retour une erreur 500...
    // c'est pourquoi nous avons mis en place un validateur très strict dans ce SDK avec tous les cas d'erreur connu.
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
