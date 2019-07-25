---
name: 1. Ping
category: Webservices Orders
---


## Envelope to test the call to your webhook order##


### Description ###

The webservice Ping allows to ask the API mapadirect to call your webhook order to check that we can access it.

HTTP header:

```
Path: /ping
Method: GET
Authorization: token your_api_key
X-SIRET: Siret_du_marchand
```

The authentication is established from the token`Api Key` of the seller on the
MAPAdirect marketplace returned by the authentication.

List of validators included in the SDK


| Field | Message |
| ------ | ------ |
| X-SIRET | The siret is mandatory and must be a sequence of 14 digits |

The answer's envelope is established in json.

Answer's HTTP :

| Status | Message |
| ------ | ------ |
| 200 | OK |
| 400 | Webhook indisponible |

Recall: in case of error on the definition of the webhook URL, to indicate to
MAPAdirect to send your orders on another address, please redo the
authentication process.

Answer's body in case of success :

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

ANswer's body in case of error (here is a redirection 302 on the webhook URL) :

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
    // List of errors returned by the SDK
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

`$data` returns a php table as described in the answer's body.

To know the technical specifications of the webhook `ping`, please read the
Webhooks rubric > Ping.