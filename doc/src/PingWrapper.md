---
name: 9. Ping (en cours)
category: Webservices
---


## Enveloppe pour tester l'appel de votre webhook order ##


### Description ###

Le webservice Ping permet de demander à l'API mapadirect d'appeler votre webhook order afin de vérifier qu'il est bien accessible.

HTTP header:

```
Path: /ping
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |
| 400 | Webhook indisponible |

Corps de la réponse :

```application/json
[
    {
        "message": "Réponse du webhook"
    }
]
```



### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$wrapper = MDApiClient::getWrapper('ping');
$wrapper->setToken(AUTH_TOKEN);
$wrapper->setSiret(SIRET);

$client = new MDApiClient();
if (!$client->call($wrapper)) {
    // webhook non disponible
}
$data = $client->getResponse()->getContent();
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.

Pour connaître les spécifications techniques du webhook `ping`, veuillez lire la rubrique Webhooks > Ping.
