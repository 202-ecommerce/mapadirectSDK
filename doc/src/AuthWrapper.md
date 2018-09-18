---
name: 1. Auth
category: Webservices
---


## Enveloppe pour s'authentifier à l'API ##


### Description ###

Le webservice d'authentification permet de retourner la clef d'API qui devra ensuite être utilisée par tous les autres webservices afin d'authentifier le marchand sur l'API MapaDirect.

L'appel à ce webservice est indispensable lors de la première utilisation de l'API MapaDirect.

Vous devez spécifier l'URL du webhook et le hash de sécurité (secret partagé avec MapaDirect).
Si vous devez par la suite changer l'url ou le hash du webhook, vous devrez renouveller l'appel à l'authentification.

HTTP header:

```
Path: /users/authenticate
Method: GET
Authorization: Basic authentication
X-SIRET: Siret_du_marchand
X-WEBHOOKURL: https://you-shop-domain.tld/webhook-mapadirect
X-WEBHOOKHASH: a_secret_path_phrase_to_authenticate_the_webhook
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
$wrapper->setCredentials('you.marchand.email@domain.tld:password');
$wrapper->setSiret('20220220220220');
$wrapper->setWebHookUrl('https://you-shop-domain.tld/module/mapadirect/ordersSync');
$wrapper->setWebHookHash('488e7cafd8fc88f386ba2a88574a7f35');

$client = new MDApiClient();
$client->call($wrapper);
$data = $client->getResponse()->getContent();
if ($client->getResponse()->isSuccess()) {
    $idMarchand = $data['id'];
    $apiKey = $data['apiKey'];
    // store API_key somewhere like in a database
} else {
    $error = $data['message'];
}
```
