---
name: 5. GetProduct
category: Webservices produits
---


## Enveloppe pour récupérer les informations d'un produit ##


### Description ###

Le webservice GetProduct permet de récupérer les informations d'un produit que vous avez préalablement soumis.


HTTP header:

```
Path: /products/{productId}
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
| 200 | The product. |
| 404 | The product was not found. |


Corps de la réponse :

```application/json
{
   "product_id":39667,
   "product_code":"3700688558930",
   "status":"D",
   "company_id":16,
   "approved":"Y",
   "weight":0,
   "timestamp":1539278245,
   "updated_timestamp":1540290381,
   "is_edp":"N",
   "unlimited_download":"N",
   "free_shipping":"N",
   "avail_since":0,
   "tax_ids":[
      4
   ],
   "crossed_out_price":0,
   "affiliate_link":"",
   "infinite_stock":false,
   "product_template_type":"product",
   "product":"Fluocompact 55 W (Croissance) 4000 °K 840 xxx",
   "short_description":"",
   "full_description":"",
   "category_ids":[
      1147
   ],
   "main_category":1147,
   "main_pair":[

   ],
   "image_pairs":[

   ],
   "video":null,
   "attachments":[

   ],
   "inventory":[
      {
         "combination":[

         ],
         "amount":3,
         "price":3
      }
   ],
   "green_tax":1,
   "supplier_ref":"",
   "condition":"N",
   "free_features":[

   ],
   "geolocation":{
      "latitude":null,
      "longitude":null,
      "label":null,
      "zipcode":null
   }
}
```
NB: Certain champs ne sont pas utilisé par MapaDirect.


### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$productId = 123;

$wrapper = MDApiClient::getWrapper('GetProduct');
$wrapper->setToken($apiKey);
$wrapper->setSiret($siret);
$wrapper->setId($productId);

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
    // Désolé mais l'API retour une erreur 500...
    // c'est pourquoi nous avons mis en place un validateur très strict dans ce SDK avec tous les cas d'erreur connu.
}
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.
