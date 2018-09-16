---
name: 7. DeleteProduct
category: Webservices
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

L'enveloppe de la réponse est établie en json.

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
$client->call($wrapper);if ($client->call($wrapper)) {
    // product deleted
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
