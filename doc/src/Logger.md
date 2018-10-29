---
name: Validateur, Exceptions & Logger
category: Introduction
---

## Validateurs de données soumises à l'API à travers les webservices ##

Le SDK possède une validation des données avant soumission à MapaDirect. Si les données à envoyer ne sont pas 100% conforme, la requète ne sera pas transmise à l'API et jettera une _exception_.

Les données des webservices produits et commandes disposent du même système de validation. La classe `MDApiWrapperValidator` ressence la liste des validateurs spécifiques.

Enfin cette documentation précise pour chaque webservice la liste des validations présentes sur chaque champs.


## Exceptions ##

### Exceptions appliquées aux webservices ###

Les wrappers des webservices sont les enveloppes qui permettent d'encapsuler les données à envoyées. La plupart du temps, le développeur dispose de getters et setters pour envoyer ou recevoir des données à travers l'API.

`MDApiWrapperValidatorException` permet de catcher les erreurs du valideur de données soumises à l'API.

L'appel d'un Wrapper n'étant pas défini par le SDK jetera une `\Exception` PHP.

### Exceptions appliquées au Webhook ###

Le webhook de commande sert à recevoir les nouvelles commandes de la part de Mapadirect ainsi que la mise à joru des statuts (reception du colis par le client, validation du règlement, ...).

La réception de données non valide sur votre webhook (secret partagé - webhookHash), données non exploitable, ... jetera une exception de type `WebhookErrorException`.

Si le corps de l'appel au webhook de commande est un tableau vide, le SDK retournera une exception `WebhookPingException` ce qui permet de vérifier que l'accès à votre webhook est bien ouvert.


## Logger ##

Le SDK dispose d'un logger qui a valeur d'interface. Il n'est pas prévu que le logger du SDK dispose de la possibilité d'écrire les logs quelques part. Pour récupérer les logs des requètes à l'API et erreurs du validateur, il est nécessaire de créer un adapter du logger `MapaDirectSDK\Logger\MDApiLogger`

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

NB: Dans tous les exemples suivants, le logger ne sera pas instancié.

Vous pouvez instancier le client avec un logger comme suit.

```php
$apiClient = new \MapaDirectSDK\MDApiClient();
$apiClient->setLogger(new MDApiLogger);
```
