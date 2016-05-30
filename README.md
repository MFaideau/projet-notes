### Installation

Le fichier SQL permettant de créer la base de données se nomme `database.sql`

##### Installation de Google OAuth

Notre système d'authentification repose sur le système de Google.

- Le dépôt Github pour l'installation :  [https://github.com/googleplus/gplus-quickstart-php]()
- Il suffit ensuite de faire : `composer install`
- On renomme le dossier `gplus-lib` que l'on déplace à la racine.
- La dernière étape consiste à obtenir une clé API de Google. Pour cela, il faut se rendre sur la page [https://console.developers.google.com/apis/credentials]()
- Une fois que le projet est créé, on récupère le `CLIENT_ID` / `CLIENT_SECRET` / `REDIRECT_URI`
- Il reste juste à mettre ces informations dans un nouveau fichier `controleurs\credentials.php`.
- Le contenu de ce fichier est:
```php
<?php
const CLIENT_ID = "";
const CLIENT_SECRET = "";
const REDIRECT_URI = "";
`
