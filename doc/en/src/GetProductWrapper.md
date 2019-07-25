---
name: 5. GetProduct
category: Webservices products
---


## Envelope to recover product's information ##


### Description ###

The webservice GetProduct allows to recover product's information that you
have submitted beforehand.


HTTP header:

```
Path: /products/{productId}
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from a token `Api Key` of the seller on the
MapaDirect marketplacereturned by the authetication.


List of validators included in the SDK

| Field | Message |
| ------ | ------ |
| X-SIRET | The siret is mandatory and must be a sequence of 14 digits. |

The envelope of the answer is established in json.

Answer's HTTP header:

| Status | Message |
| ------ | ------ |
| 200 | The product. |
| 404 | The product was not found. |


Answer's body:

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

NB: Some fields are not used by MapaDirect.


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
    // List of errors returned by SDK.
    $client->getErrors();
    exit;
}
if ($client->getResponse()->isSuccess()) {
    $data = $client->getResponse()->getContent();
} else {
   // Sorry but the API returns an error 500.
   // That is why we have put into place a very strict validator in this SDK with every case of known error.
}
```

`$data` return a php table as described in the answer's body .
