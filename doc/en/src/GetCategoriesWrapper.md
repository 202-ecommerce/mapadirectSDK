---
name: 3. GetCategories
category: Webservices products
---


## Envelope to list the'category tree ##


### Description ###

The webservice `GetCategories` lists all the categories available on the
MapaDirect marketplace.

It is essential during the initialization of your catalog to get the category
list. You will then be able to submit your product catalog by associating them
to the MapaDirect marketplace tree.

**We strongly recommend you to set up a system to cache your reply to this
webservice.**

Request HTTP header:

```
Path: /catalog/categories/tree
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token `Api Key` of the seller on MapaDirect marketplace returned by the authentication.

The answer envelope is established in json.

Answer's HTTP header:

| Status | Message |
| ------ | ------ |
| 200 | OK |

Answer's body:

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
// recommended caching of $data 
```

`$data` return a php array as described in the answer body.
