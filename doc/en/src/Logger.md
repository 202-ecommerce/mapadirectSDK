---
name: Validator, Exceptions & Logger
category: Introduction
---

## Validators of data subject to the'API through the webservices ##

The SDK has data validation before submission to MapaDirect. If the data to be
sent are not 100% consistent, the request will not be transmitted to the 'API
and will throw an _exception_.

The data from the products and orders webservices have the same validation
system. The class`MDApiWrapperValidator` identify the list of specific
validators.

Finally this documentation gives for each webservice a list of validations
present on each field.


## Exceptions ##

### Exceptions applied to the webservices ###


The webservices' wrappers are the envelopes that'encapsulate the data to be
sent. Most of the time, the developer has getters and setters to send or
receive data through the'API.

`MDApiWrapperValidatorException` allows to catch the errors of the data
validator subject to the API.

The call of a Wrapper which is not defined by the SDK will throw a`\Exception`
PHP.

### Exceptions applied to the Webhook ###

The order webhook allows to receive new orders from Mapadirect as well as the
status update (receipt of the package by the customer, validation of the
payment,...).


The reception of invalid data on your webhook (shared secret -
webhookHash),non exploitable data, ... will throw an exception of the form
`WebhookErrorException`.


If the body of the call to the order webhook is an empty array, the SDK will
return an exception `WebhookPingException` which allows to check that the
access to your webhook is open.

## Logger ##

The SDK has a logger which has value of 'interface. It 'is not planned that
the SDK has the ability to'write logs somewhere. To recover the request logs
to the'API and validator errors, it is necassary to create a logger's
adaptation`MapaDirectSDK\Logger\MDApiLogger`

Exemple :

```php
use MapaDirectSDK\Logger\MDApiLogger as MDApiLoggerDefault;

class MDApiLogger extends MDApiLoggerDefault
{

    public function write($level = 'info', $message = '', $wrapper = '')
    {
        file_put_contents($level . '.file.log', '[' . $wrapper . ']' . $message);
    }
}
```

NB: In all the following examples, the logger will not be instantiated.

You can instantiate the customer with a logger as follows.

```php
$apiClient = new \MapaDirectSDK\MDApiClient();
$apiClient->setLogger(new MDApiLogger);
```
