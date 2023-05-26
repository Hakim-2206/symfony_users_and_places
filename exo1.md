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

## Etape 3 : ajout de produits

- Créer un nouveau controller `AdminProductController`
- La méthode index de ce controller (route : admin/product/) doit afficher la liste des produits sous la forme d'un tableau (interface d'administration de gestion de produit)
- Dans cette page on va créer un bouton "Ajouter un produit" : lien vers une nouvelle route (admin/product/add/) et donc nouvelle méthode dans nos controller.
- A l'aide de cette documentation (https://symfony.com/doc/current/forms.html) vous allez maintenant dans cette méthode créer un nouveau formulaire mais aussi par la suite traiter ce formulaire.
- Dans un premier temps on va afficher le formulaire
- Vous devez créer une classe From spécifique (ProductType) pour votre entité product, reportez vous donc à la bonne partie de la documentation et utilisez le maker (make:form)
- Cette classe ProductType va définir tous les champs à afficher dans le formulaire, vous allez toutefois rencontrer un problème au niveau du champ 'category' avec la configuration par défaut. Dans un premier temps et pour afficher votre formulaire, vous pouvez mettre en commentaire le `->add('category')` dans votre classe ProductType.
- Une fois le formulaire correctement affiché, vous pouvez dans votre vue ajouter un bouton submit, mais vous verrez qu'il est aussi possible de l'ajouter dans la classe ProductType
- Maintenant vous allez regarder du côté du champ category dans le formulaire ProductType pour l'ajout d'un produit, nous devons ici sélectionner une catégorie existante dans une liste déroulante. Pour cela vous allez devoir paramétrer le champ `category` dans la classe ProductType. Regarder du côté de la doc (https://symfony.com/doc/current/reference/forms/types.html). On peut donc enlever le commentaire et ajouter le type en deuxième paramètre de `add`. Ce type comporte aussi des paramètrse complémentaires. Regardez du côté des Choice Fields > EntityType
- Une fois le champs bien paramétré vous devriez voir une liste déroulante avec toutes les catégories dedans.
- Vous pouvez maintenant passer à la validation du formulaire en suivant la documentation préalable. Et donc pouvoir ajouter un nouveau produit, puis vous rediriger vers la liste des produits créée au début de cette partie.


## Etape 4 : 
- produire la même chose pour les catégories et donc permettre d'ajouter une catégorie


## Etape 5 : 
- permettre l'édition d'un produit, puis d'une catégorie
- pour cela, nous utilisons le même processus que pour l'ajout mais notre entité de départ (qui sert à la création du fomulaire n'est pas vide)

```php
// pour l'ajout $product était un nouveau produit, que se passe t'il si $product contient
// un produit existant
// vous pouvez créer une route qui reçoit l'id du produit et le charge avec @ParamConverter
// et du coup tester le code de l'ajout sans la création initial du product
$form = $this->createForm(ProductType::class, $product);
```

## Etape 6 : 
- créer un dépôt GITHUB et pusher votre projet dessus, me donner le lien ;)

## Etape 7 :
- création de la suppression d'un produit, puis d'une catégorie (impossible si des produits y sont associés)
- /!\toute modification de la base doit se faire en méthode POST et vous devez faire une Redirection After POST. La méthode de suppression ne doit répondre qu'à une requête POST 
- Pour sécuriser la suppression vous devez inclure un token CSRF : https://symfony.com/doc/current/security/csrf.html#generating-and-checking-csrf-tokens-manually
- Et donc vérifier le token avant de supprimer
- Puis une fois cela fonctionnel, vous devez demander une confirmation avant la suppression. Utilisez une modale Bootstrap... et donc un peu de JS. Le formulaire est dans la modale, mais il ne doit y avoir qu'une modale dans votre page. Donc en JS : modification de l'url (route) de soumission du formulaire avec l'id du produit

## Etape 8 : upload des images
- créez un service d'upload : https://symfony.com/doc/current/controller/upload_file.html
- permettre à notre service de recevoir un sous dossier en plus du dossier d'upload, par exemple 'product' ou 'category'. Ce dossier sera transmis à la méthode upload lors de l'appel. IL mpermet de classer les uploads dans le dossier uploads mais dans des sous dossier selon les entités.
- utiliser ce service pour Uploader l'image, donc ajouter un champ de type file pour l'image dans le formulaire productType, récupérez là dans le controller et uploadez la
- reportez vous à la documentation, vous pouvez d'abord tester un upload directement dans le contrôleur pour le comprendre, puis passer à la création du servie.

# Etape 9 : Readme

Faire un readme.md pour expliquer les étapes pour installer et tester votre projet.

# Etape 10 : Sécurisation de l'admin

- Créer une entité utilisateur (provider pour le firewall) avec un `make:user` : https://symfony.com/doc/current/security.html#the-user
- Créer un CRUD pour les utilisateurs avec un controller "AdminUserController"
- Modifier le "UserType" pour créer une sélection multiple pour le ROLE et un champ double non mappé pour le password (le mot de passe en clair ne doit pas être mappé avec l'entité)

```php
->add('roles', ChoiceType::class, [
    'required' => true,
    'multiple' => true,
    'choices' => ['Admin' => 'ROLE_ADMIN', 'Manager' => 'ROLE_MANAGER', 'Customer' => 'ROLE_CUSTOMER']
])
->add('plainPassword', RepeatedType::class, [
    'type' => PasswordType::class,
    'mapped' => false,
    'first_options'  => ['label' => 'Mot de passe'],
    'second_options' => ['label' => 'Confirmer mot de passe'],
    'attr' => ['autocomplete' => 'new-password'],
    'constraints' => [
        new NotBlank([
            'message' => 'Please enter a password',
        ]),
        new Length([
            'min' => 6,
            'minMessage' => 'Your password should be at least {{ limit }} characters',
            // max length allowed by Symfony for security reasons
            'max' => 4096,
        ]),
    ],
])
```
On peut récupérer le plainPassword dans le COntroller et le Hasher : 
```php
//...
$plaintextPassword = $form->get("plainPassword")->getData();
// hash the password (based on the security.yaml config for the $user class)
$hashedPassword = $passwordHasher->hashPassword(
    $user,
    $plaintextPassword
);
$user->setPassword($hashedPassword);
```

- Dans le controller du CRUD, pour l'ajout d'un utilisateur, vous devez récupérer le mot de passe 'plainPassword' et le hasher avant de le rajouter dans l'entité, puis flusher vers la base
- Ajouter un utilisateur dans votre base
- Créez un formulaire de login : https://symfony.com/doc/current/security.html#form-login avec un token CSRF
- Modifier le fichier "security.yaml" dans config, et modifier le "access_control:" pour sécuriser toutes les routes commençant par 'admin/' et permettre l'accès au utilisateur connecté avec le role ROLE_ADMIN
- Vous pouvez vous connecter ! 
- Gérez le logout avec une route /logout

# Etape 11 : Création de client

- Créez une entité Customer (firstname, lastname, address, zipCode, city, country, phone)
- Relation OneToOne avec un User
- Migration vers la base

- Faire un formulaire d'authentification  avec " make:registration-form" pour l'entité USER
- Valider un email de confirmation
- Corriger le code pour demander 2 fois le mot de passe et affecter un ROLE_CUSTOMER à l'enregistrement (ne pas demande rôle bien sûr)
- Rajouter le formulaire pour saisir en même temps le customer associé : https://symfony.com/doc/current/form/embedded.html

- il faudra apporter quelques modification :
  - faire une migration pour le isValidate
  - remonter les messages Flash dans notre interface (on verra les messages Flash en Juin)

# Etape 12 : Récupérer l'email de validation
- Télécharger MailHog pour votre système
- Exécutez le (de sang froid)... une fenêtre reste ouverte (fait froid)
- Configurer l'envoie d'email symfony dans le .env.local :

```bash
# on envoie les message en mode synchrone pour notre cas
MESSENGER_TRANSPORT_DSN=sync://
# on utilise le SMTP de MailHog pour l'envoi des email... tous les emails seront capturés
MAILER_DSN=smtp://127.0.0.1:1025
```

- connectez vous à mailHog : http://localhost:8025/ vous valider l'email d'enregistrement !


# Etape 13 :
- Optimisation des entités avec les dates : https://github.com/doctrine-extensions/DoctrineExtensions/blob/main/doc/timestampable.md#entity-mapping