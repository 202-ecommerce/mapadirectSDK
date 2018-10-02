---
name: 3. GetCategories
category: Webservices produits
---


## Enveloppe pour lister l'arborescence des catégories ##


### Description ###

Le webservice `GetCategories` permet de lister toutes les catégories disponible sur la marketplace MapaDirect.

Il est indispensable à l'initialisation de votre catalogue de récupérer la liste des categories.
Vous pourrez ainsi soumettre votre catalogue de produits en les associant à l'arborescence de
la marketplace MapaDirect.

**Nous recommandons très fortement de mettre en place un système permettant de mettre en cache la réponse de ce webservice.**

HTTP header de la requète :

```
Path: /catalog/categories/tree
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

$wrapper = MDApiClient::getWrapper('GetCategories');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);

$client = new MDApiClient();
$client->call($wrapper);
$data = $client->getResponse()->getContent();
// mise en cache de $data recommandée
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
