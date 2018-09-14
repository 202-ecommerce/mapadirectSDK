---
name: GetTaxes Wrapper
category: Wrappers
---


## GetTaxes Wrapper ##


### Description ###

Le webservice GetTaxes permet de lister toutes les taxes (TVA) disponible.

Chemin: /taxes
Méthode: GET
HTTP header:

```
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

L'authentification est établie à partir du token `Api Key` du marchand sur la marketplace MapaDirect retourné par l'authentification.

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |

Corps de la réponse :

```application/json
[
    {
        "tax_id": 0,
        "tax": "TVA 20%"
    }
]
```


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$client = new MDApiClient();
$wrapper = MDApiClient::getWrapper('GetTaxes');
$wrapper->setToken(Configuration::get(Mapadirect::AUTH_TOKEN));
$wrapper->setSiret(Configuration::get(mapadirect::SIRET));
$client->call($wrapper);
$data = $client->getResponse()->getContent();
```

$data retourne un tableau php comme décrit dans le corps de la réponse.
