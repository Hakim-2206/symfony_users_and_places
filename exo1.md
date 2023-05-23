# Premier site Symfony


## Etape 1

- Installer Symfony
- Configurer .env.local pour accès à une base de données MySql
- Créer une entité product (name, description, picture, price, createdAt, modifiedAt, slug)
- Créer la base de données et faire une migration
- Installer les Fixtures Doctrine et FakerPhp
- Utiliser la fixture App pour créer 20 produits dans la base de données 
- Créer un controller FrontController, la méthode index doit répondre à la route '/' (racine/accueil)
- Dans cette méthode récupérer les produits à l'aide du Repository (findAll)
- Passer ces données à la vue et afficher les produits (name, picture, price)
- Ajouter dans public une feuille de style (bootstrap) et la mettre en lien pour tout le site (utilisation des assets avec Twig)
- Mettre un minimum en page l'affichage des produits avec les CARD bootstrap
- Créer une route pour gérer les pages statiques
- Ajouter 2 pages (présentation, mentions légales)
- Mettre en lien la page présentation dans une barre de navigation (utilisations de path dans twig)

## Etape 1.2
- Ajouter un bouton "Détails" pour chaque produits
- En cliquant sur Détails on affiche une page avec les détails du produits, on doit donc créer une nouvelle route avec l'id dynamqie d'un produit
- Modifier cette route pour utiliser le slug à la place de l'id dans la route
- Regarder du côté de l'entité pour définir le Slug comme une propriété Unique
- Pensez à migrer vers la base vos modification

## Etape 2

- Créer une entité catégorie (name, slug, description, picture)
- créer une relation OneToMany (chaque Produit appartient à une Catégorie)
- ajouter des données Fake, des 10 produits dans 10 catégories
- créer un lien catégorie dans le menu qui affiche une page avec toutes les catégories
- quand on clique sur une cétégorie on affiche tous les produits de cette catégorie
