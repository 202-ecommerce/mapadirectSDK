---
name: 3. SetTracking
category: Webservices commandes
---


## Enveloppe pour envoyer les numéros de tracking des colis expédiés ##


### Description ###

Le webservice `SetTracking` permet d'envoyer un numéro de tracking d'une commande.

HTTP header:

```
Path: /shipments
Method: POST
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Corps de la requète :

```application/json
{
   "order_id" : "123",
   "comments" : "Colissimo https://sample.com/ddd",
   "trackign_number": "FDSXXX",
   "products": {
        "123456": 3
   }
}
```

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET (envoyé en header) | Le siret est obligatoire et être un chiffre de 14 caractères. |
| order_id | Le numéro de commande est obligatoire et doit être un entier naturel. |
| comments | Texte contenant l'URL de tracking si possible. |
| trackign_number | Numéro de tracking. Par défaut vauqt "colis_non_suivi" si non défini. |
| products | Tableau des produits expédiés contenant [id_produit => quantité] |

NB : Si plusieurs colis sont nécessaire, il est possible d'appeler plusieurs fois la requète avec le contenu détaillé de chaque colis.


L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |
| 400 | Un des attributs de la requête est erroné. |


Corps de la réponse :

```application/json
{
}
```

### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$orderId = 123;
$tracking = [
   "comments" => "Colissimo https://tracking.colissimo.com/FDSXXX",
   "trackign_number" => "FDSXXX",
   "products" => [
        "123456" => 3
   ]
];

$wrapper = MDApiClient::getWrapper('SetTracking');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($orderId);
$wrapper->setInput($tracking);

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

NB : Pour respecter la nomenclature d'appel des webservices de MapaDirect, le SDK permet de saisir compléter l'id de commande `order_id` en passant par le setId ce qui completera le corps de la requète.

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
