# Projet Web Serive - Massa Alexis - Dumas Guillaume
## Contenu
### mi5-symfony
Projet Symfony de départ, adapté lors de la réalisation de ce projet
Run :`symfony server:start --no-tls`
Accueil : 127.0.0.1:80000/
Api Platform : 127.0.0.1:80000/api
WSDL generation : 127.0.0.1:80000/soapgen
WSDL : 127.0.0.1:80000/soap?wsdl

### WampServerSoapClient 
Fichiers placés dans Wamp afin de faire des appels au serveur Soap contenu dans mi5-symfony
Je n'ai pas réussi à réaliser d'opérations "correctement", explication (aussi en commentaire dans mi5-symfony/src/Soap/SoapOperations.php) :
```js
/*
 * ! Je ne sais pas pourquoi cela ne fonctionne pas, il est impossible d'utiliser getRepository(), sinon erreur :
 * Internal Server Error in C:\wamp64\www\SymfonySoapClient\OperationsSoapClient.php
 * sur la ligne d'appel des fonctions getProductNameById et getUserCommands
 * 
 * Si la fonction ne contient pas d'appel à getRepository(), cela fonctionne correctement
 * Pour le montrer j'ai créé pour chacune des deux fonctions une fonction qui n'utilise pas getRepository(), en mettant des données en dur
 * get_product_name_by_id() et get_user_commands() respectivement
 */
```
Pas d'utilisation de types complexes à cause du problème mentionné ci-dessus

### JShop
Java Web Application et RESTful API générée grâce au reverse-engineering de la BDD

### JShopTest 
Test de l'API REST de JShop
Clic droit > Tester l'API REST sur la node JShop/RESTful Web Service (Dans Netbeans)
Puis URL http://localhost:8080/JShopWSTest/test-resbeans.html

### JShopSeClient 
Tentative de génération de Web Service à partir du wsdl de mi5-symfony, sans succès
Cause : Configuration de SOAP dans le serveur Tomcat (je pense) fait que le "projet" n'arrive pas à lire le WSDL