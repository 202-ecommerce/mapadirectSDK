---
name: 1. Ping
category: Webservices commandes
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

Liste des validateurs inclus dans le SDK

| Champs | Message |
| ------ | ------ |
| X-SIRET | Le siret est obligatoire et être un chiffre de 14 caractères |

L'enveloppe de la réponse est établie en json.

HTTP header de réponse :

| Statut | Message |
| ------ | ------ |
| 200 | OK |
| 400 | Webhook indisponible |

Rappel : En cas d'erreur sur la définition de l'URL du webhook, pour indiquer à MapaDirect d'envoyer vos commandes sur à une autre adresse, veuillez relancer la procédure d'authentification.

Corps de la réponse en cas de succès :

```application/json
{
   "statusCode":201,
   "body":{
      "success":true,
      "message":"Ping OK"
   },
   "headers":{
      "server":"nginx/1.6.2",
      "date":"Mon, 22 Oct 2018 12:57:26 GMT",
      "content-type":"application/json",
      "content-length":"36",
      "connection":"close"
   },
   "request":{
      "uri":{
         "protocol":"http:",
         "slashes":true,
         "auth":null,
         "host":"your.domain.tld",
         "port":80,
         "hostname":"your.domain.tld",
         "pathname":"/module/mapadirect/ordersSync",
         "path":"/module/mapadirect/ordersSync",
         "href":"http://your.domain.tld/module/mapadirect/ordersSync"
      },
      "method":"PUT",
      "headers":{
         "Content-Type":"application/json",
         "Accept":"*/*",
         "X-WEBHOOKHASH":"xxxxxxxxxxxxxxxxxx",
         "content-length":2
      }
   }
}
```

Corps de la réponse en cas d'erreur (ici, on a une redirection 302 sur l'URL du webhook) :

```application/json
{
   "object":"302 - undefined",
   "invalidities":{
      "errors":[
         {
            "name":"StatusCodeError",
            "statusCode":302,
            "message":"302 - undefined",
            "options":{
               "headers":{
                  "Content-Type":"application/json",
                  "Accept":"*/*",
                  "X-WEBHOOKHASH":"xxxxxxxxxxxxxxxxxx"
               },
               "method":"PUT",
               "json":true,
               "resolveWithFullResponse":true,
               "uri":"http://your.domain.tld/module/mapadirect/ordersSync",
               "body":{

               },
               "simple":true,
               "transform2xxOnly":false
            },
            "response":{
               "statusCode":302,
               "headers":{
                  "server":"nginx/1.6.2",
                  "date":"Thu, 25 Oct 2018 16:23:51 GMT",
                  "content-type":"text/html; charset=UTF-8",
                  "content-length":"0",
                  "connection":"close",
                  "expires":"Mon, 26 Jul 1997 05:00:00 GMT",
                  "last-modified":"Thu, 25 Oct 2018 16:23:51 GMT",
                  "cache-control":"no-store, no-cache, must-revalidate, post-check=0, pre-check=0",
                  "pragma":"no-cache",
                  "location":"../"
               },
               "request":{
                  "uri":{
                     "protocol":"http:",
                     "slashes":true,
                     "auth":null,
                     "host":"your.domain.tld",
                     "port":80,
                     "hostname":"your.domain.tld",
                     "hash":null,
                     "search":null,
                     "query":null,
                     "pathname":"/module/mapadirect/ordersSync",
                     "path":"/module/mapadirect/ordersSync",
                     "href":"http://your.domain.tld/module/mapadirect/ordersSync"
                  },
                  "method":"PUT",
                  "headers":{
                     "Content-Type":"application/json",
                     "Accept":"*/*",
                     "X-WEBHOOKHASH":"xxxxxxxxxxxxxxxxxx",
                     "content-length":2
                  }
               }
            }
         }
      ]
   }
}
```

### Exemple ###

```php
use MapaDirectSDK\MDApiClient;

$wrapper = MDApiClient::getWrapper('Ping');
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
} else {
    $data = $client->getResponse()->getContent();
}


$client = new MDApiClient();
$client->call($wrapper);
$success = $client->getResponse()->isSuccess();
```

`$data` retourne un tableau php comme décrit dans le corps de la réponse.

Pour connaître les spécifications techniques du webhook `ping`, veuillez lire la rubrique Webhooks > Ping.
