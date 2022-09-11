# pop

Et bienvenue dans le Proget Poils o Pattes - Gestion backend d'un salon de toilettage

## Explications :

On était une équipe de 5 à travailler dessus : 3 en front (sur react) et 2 sur le back (Wordpress)

## Le plugin :

### Fonctionnalités :

- crée 2 databases custom (pour gérer les services & le calendrier)
- crée les menus de gestion pour ces tables
- crée des routes custom pour délivrer des informations pertinentes au front depuis ces custom tables.
- crée des nouveaux rôles et leurs capacités : Customers et stackholder (çà veut dire toiletteur)
- crée des customs Post Types pour la gestion des chiens et des produits
- crée des taxonomies pour tout ce petit monde.

### Language :

- PHP (+ fonctions wordpress) pour les cpt, les rôles, la création des tables etc.
- PHP intégrant du HTML / CSS / JS "à la vanille" pour les pages de gestion des tables (Le CRUD du calenrier utilise l'API de WordPress et les routes custom).

### L'installation :

Attention c'est musclé !

0- NE PAS CLONER CE REPO IMMÉDIATEMENT (NON !)

1. Créer une installation de WordPress toute fraîche, toute neuve.
   (un ```composer require roots/wordpress``` fera largement l'affaire, puis créer la DB et enfin un wp core install ou alors un bon vieux bedRock des familles enfin bref, vous connaissez.)
2. installer dans cette fraîche installation le plugin JWT-autentication-le-nom-de-plugin-le-plus-long-du-monde-que-j-ai-jamais-vu-de-ma-vie
3. dans l'administration de WP, rafraichir les permalinks.
4. Ajouter dans le .htaccess les 3 lignes du plugin JWT : çà devrait ressembler à çà :

   ```
   RewriteCond %{HTTP:Authorization} ^(.*)
   RewriteRule ^(.*) - [E=HTTP_AUTHORIZATION:%1]
   SetEnvIf Authorization "(.*)" HTTP_AUTHORIZATION=$1
   ```
5. Cloner le repo **DANS UN DOSSIER SÉPARÉ** DE CELUI DANS LEQUEL VOUS VENEZ D'INSTALLER WP ! (sans rire c'est important ;-))
6. Copier l'intégralité du repo dans le dossier où vous avez installé WP.

6bis. : Il va vous demander si vous voulez écraser certains fichiers

* du plugin JWT, (dites oui, Je l'ai modifié pour qu'il envoie l'ID user en retour de connexion réussie en plus du token etc.)
* wp_api_rest_user (dites oui, je l'ai aussi modifié pour pouvoir créer un compte depuis la route API

6ter - (pensez bien à inclure le dossier caché .git)

7. En ligne de commande, aller dans le dossier du plugin poils-o-pattes, et ici, faire un composer install. Pouruqoi ? Parce que le plugin utilise AltoRouter pour la gestion des namespaces !
8. Prenez un bon café, bravo ! Vous y êtes arrivés (j'avoue ct pô simple) !

### La présentation de ce repo en vidéo :

Vous avez de la chance, elle est est sur YT !

çà se passe ici : https://www.youtube.com/embed/Q3WiRGLeXSQ?start=2320

Sur ce profitez-bien, hésitez pas l'ouvrir, et à me dire ce que vous en pensez !