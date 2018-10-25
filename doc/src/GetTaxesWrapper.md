---
name: 2. GetTaxes
category: Webservices produits
---


## Enveloppe pour lister les taxes (TVA) ##


### Description ###

Le webservice `GetTaxes` permet de lister toutes les taxes (TVA) disponible.

Il est nécessaire à l'initialisation de votre catalogue de récupérer les identifiants de taxes
afin de compléter votre catalogue de produits avec les valeurs de taxe correspondant à la fiscalité
de vos produits.

**Nous recommandons très fortement de mettre en place un système permettant de mettre en cache la réponse de ce webservice.**

HTTP header:

```
Path: /taxes
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET | Le siret est obligatoire et être un chiffre de 14 caractères |

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |

Corps de la réponse :

```application/json
[
   {
      "tax_id":2,
      "tax":"TVA 2.1%"
   },
   {
      "tax_id":3,
      "tax":"TVA 5.5%"
   },
   {
      "tax_id":4,
      "tax":"TVA 10%"
   },
   {
      "tax_id":5,
      "tax":"TVA 20%"
   },
   {
      "tax_id":1,
      "tax":"TVA 0%"
   }
]
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$wrapper = MDApiClient::getWrapper('GetTaxes');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);

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
    // mise en cache de $data recommandée
} else {
    // Désolé mais l'API retour une erreur 500...
    // c'est pourquoi nous avons mis en place un validateur très strict dans ce SDK avec tous les cas d'erreur connu.
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
