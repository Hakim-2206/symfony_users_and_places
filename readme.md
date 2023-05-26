# Symfony première installation

Retouvez les notions et les commandes de bases de Symfony

## Préalable

- php > 8 en ligne de commande
- installer composer


## Importants

Toutes ses commandes sont à exécuter dans le dossier de votre projet Symfony.
Déplacez vous dans le dossier en ligne de commande avec la commande `cd`.

Les commandes qui commencent par `php bin/console` peuvent commencer par `symfony console` à la place si vous avez installé l'éxécutable Symfony.


## Installation

Pour faciliter l'installation et le travail avec Symfony vous pouvez installer l'éxécutable Symfony.

    > https://symfony.com/download

```bash
# installer Symfony dans le dossier courant !
symfony new --webapp ./
```

Vous pouvez aussi utiliser Composer pour installer Symfony. 

```bash
# installer Symfony dans le dossier courant !
composer create-project symfony/skeleton ./
```

    > https://symfony.com/doc/current/setup.html


/!\ Sans l'exécutable Symfony vous n'avez pas de serveur à disposition. Il vous faudra paramétrer un serveur Web (utiliser Apache ou Nginx avec Mamp ou Wamp ou Laragon). Il faudra aussi installer un package supplémentaire pour la réécriture d'URL pour Apache (Apache Pack).

    > https://symfony.com/doc/current/setup/web_server_configuration.html


## Commandes de bases


### Cache

```bash
#vide le cache
php bin/console cache:clear
```

### Composer autoload

```bash
#regénère l'autoload de Composer (en cas de modification des classes, suppression)
composer dump-autoload
```

### Serveur Web

Pour accéder au site Symfony, il est conseillé en local/dev d'utiliser le serveur fourni avec l'exécutable.
L'url fournie pointera directement dans le dossier `public/`

```bash
#start serveur
symfony server:start

#stop serveur 
symfony server:stop
```

> https://symfony.com/doc/current/setup/symfony_server.html#getting-started


### Paramétrer et créer la base de données

Editez le fichier .env à la racine et paramétrer la variable d'environnement `DATABASE_URL`.
/!\ En local il est conseillé de créer un fichier de surcharge `.env.local`

```bash
#exemple avec un MYsql Local
DATABASE_URL="mysql://root:@127.0.0.1:3306/3waFSD39-demo?serverVersion=8.0.30&charset=utf8mb4"
```

Vous pouvez ensuite créer la base de donnée en ligne de commande : 

```bash
#créer la base "3waFSD39-demo" sur le serveur 
php bin/console doctrine:database:create
```

> https://symfony.com/doc/current/doctrine.html#configuring-the-database


### Maker Controller et Entity

```bash
#création controller
php bin/console make:controller
```

> https://symfony.com/doc/current/the-fast-track/en/6-controller.html


```bash
#création entity
php bin/console make:entity
```

> https://symfony.com/doc/current/doctrine.html


### Migrer le schéma des entités vers un schéma de données

```bash
#faire une migration (prise en charge de modification des entités)
php bin/console make:migration

#migrer le schéma vers la base
php bin/console doctrine:migrations:migrate
```
> https://symfony.com/doc/current/doctrine.html#migrations-creating-the-database-tables-schema


Type de propriété dans les entités

Les relation entre entités

La création de formulaire basé sur une entité

make:form

Gérer le type de champ des formulaires

type de champs

Valider, gérer les contraintes sur les champs

validation/contraintes

Automatiser la création d'un CRUD

make:crud

Automatiser la création d'une classe User

make:user


Création d'un formulaire de login

login

make:registration-form