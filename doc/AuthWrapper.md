---
name: Auth Wrapper
category: Wrappers
---


## Authentication Wrapper ##


### Description ###

Le webservice d'authentification permet de retourner la clef d'API qui sera ensuite utilisé par autes webservice pour authentifier le marchand sur l'API mapadirect.

Chemin: /users/authenticate
Méthode: GET
HTTP header:

```
Authorization: Basic authentication
X-SIRET: Siret_du_marchand
X-WEBHOOKHASH: a_secret_path_phrase_to_authenticate_the_webhook
X-WEBHOOKURL: https://you-shop-domain.tld/webhook-mapadirect
```

L'authentification est établie à partir de l'identifiant / mot de passe du marchand sur la marketplace MapaDirect.

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |
| 401 | Erreur |

Messages d'erreur :

* Unknown SIRET number
* Unauthorized
* ...

### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$wrapper = MDApiClient::getWrapper('Auth');
$client = new MDApiClient();
$wrapper->setCredentials('you.marchand.email@domain.tld:password');
$wrapper->setSiret('20220220220220');
$wrapper->setSecureKey('488e7cafd8fc88f386ba2a88574a7f35');
$wrapper->setWebHookUrl('https://localhost/mapadirect/module/mapadirect/ordersSync');
$client->call($wrapper);
$data = $client->getResponse()->getContent();
if ($client->getResponse()->isSuccess()) {
    $idMarchand = $data['id'];
    $apiKey = $data['apiKey'];
} else {
    $error = $data['message'];
}
```
