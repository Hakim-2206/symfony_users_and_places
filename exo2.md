# Site de partage de lieux insolites

## Fonctionnalités

Des utilisateurs peuvent consulter la page d'accueil du site qui donne accès à l'inscription et au login. 

Des utilisateurs peuvent consulter une liste des lieux insolites proposés par d'autres, sur la page d'accueil et classés par date de publication décroissante.

Des utilisateurs peuvent consulter le détails d'un lieu insolite (Descriptions, photos) 

Des utilisateurs peuvent créer leur compte et seront connectés automatiquement (pas de vérif email)

Des utilisateurs connectés peuvent consulter la page d'accueil et accéder au logout

Des utilisateurs connectés peuvent accéder à saisie d'un lieu insolite

Des utilisateurs connectés peuvent lister leurs lieux insolites

### En option 

Des utilisateurs connectés peuvent éditer leurs lieux insolites

Des utilisateurs connectés peuvent supprimer leurs lieux insolites

Des utilisateurs peuvent visualiser le détail d'un lieu insolite avec une carte de localisation (LeafLet)


## Les données

Un lieu est représenté par :
- Un nom
- Une description
- Des coordonnées GPS (latitude et longitude)
- Des photos (plusieurs photo par lieu)
- Une date de publication et de mofification
- L'utilisateur qui a créé le lieu


Un utilisateur est représenté par :
- un nom et prénom
- un avatar (ume image)
- un nom d'utilisateur
- un email et password pour la connexion

Tous les utilisateurs n'ont qu'un rôle `ROLE_USER` et toutes les données sont gérées dans l'entité User. On connecte l'utilisateur avec son email et son mot de passe.


# Instructions complémentaires 

Vous devez partir d'une nouvelle installation de Symfony.

Vous devez publier votre support sur Github et me transmettre le lien.

Vous devrez me faire une démo de votre support en fin de journée.

**Quelques astuces**
- Commencer par réfléchir à vos entités et leur relation
- Créez la base de données, vos entités (utilisez le make:user pour l'entité user) et leur relation et migrez vers la base
- Créez les fonctionnalités de création de compte
- Créez la partie saisie d'un lieu (utilisez le crud de Symfony)
- Permettre l'ajout de plusieurs photos une fois un lieu créé (on ne saisie pas les photos dans le formulaire d'un lieu). Il faudra passer par le Crud symfony pour les photos mais y ajouter une gestion de l'identifiant du lieu.
- Pour la mise en page, faire au plus simple, utilisez un Bootstrap, TailWind. Ce n'est pas le plus important et ça doit arriver à la fin !