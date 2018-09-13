---
name: GetCategories Wrapper
category: Wrappers
---


## GetCategories Wrapper ##


### Description ###

Le webservice GetTaxes permet de lister toutes les catégories disponible sur la marketplace.

Chemin: /catalog/categories/tree
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
[{
    "id": 0,
    "parentId": 0,
    "name": "Couches and chairs",
    "description": "<p>List of couches and chairs for your living room.</p>",
    "slug": "couches-and-chairs",
    "image":
    {
        "id": 0
    },
    "position": 0,
    "productCount": 123,
    "seoData":
    {
        "title": "Online Shopping for Electronics, Apparel, Computers, Books, DVDs & more",
        "description": "Online shopping from the earth's biggest selection of books, magazines, music, DVDs, videos, electronics & dsl, gourmet food & just about anything else."
    },
    "categoryPath":
    [
            {
                "id": 8,
                "name": "Couches and chairs",
                "slug": "couches-and-chairs"
            }
    ]
}]
```



### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$client = new MDApiClient();
$wrapper = MDApiClient::getWrapper('GetCategories');
$wrapper->setToken(AUTH_TOKEN);
$wrapper->setSiret(SIRET);
$client->call($wrapper);
$data = $client->getResponse()->getContent();
```

$data retourne un tableau php comme décrit dans le corps de la réponse.
