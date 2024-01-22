# SAE 301 : Site e-commerce de parfum

## Description

Le projet est un site e-commerce de parfum réalisé en utilisant l'architecture MVC (Modèle-Vue-Contrôleur). Il permet aux utilisateurs de parcourir et d'acheter différents parfums en ligne.

## Technologies Utilisées

- SQL
- PHP
- JavaScript
- HTML
- CSS

## Fonctionnalités Principales

1. Accueil :
   - Tri des produits par leur famille : Permet aux utilisateurs de filtrer les produits affichés sur la page d'accueil en fonction de leur catégorie, facilitant ainsi la navigation et la recherche.
2. Boutique :
   - Tri des produits en fonction de leur prix, leur quantité ou la valeur de leur promotion
   - Présente de manière claire et attractive les détails des produits disponibles, facilitant ainsi la sélection et l'achat.
2.2.3. Manage (admin) :
   - Permet aux administrateurs d'ajouter de nouveaux produits à la base de données, étendant ainsi le catalogue de l'application.
   - Autorise les administrateurs à apporter des modifications aux informations des produits existants, garantissant des données précises et à jour.
   - Donne aux administrateurs la possibilité de retirer des produits du catalogue, assurant ainsi une gestion efficace du contenu.
   - Permet aux administrateurs de créer des promotions pour des produits spécifiques, dynamisant les stratégies marketing.
2.2.4. Profil :
   - Donne aux utilisateurs la possibilité de mettre à jour les détails de leur compte, assurant des informations correctes et actuelles.
   - Permet aux utilisateurs de se déconnecter de leur compte en toute sécurité.
   - Fournit un historique détaillé des commandes précédemment effectuées et payées.
2.2.5. Connexion :
   - Permet aux utilisateurs de s'authentifier et d'accéder à leur compte personnel.
2.2.6. Inscription :
   - Offre la possibilité aux visiteurs de devenir des utilisateurs en créant un compte, permettant ainsi une expérience personnalisée.
2.2.7. Panier :
   - Autorise les utilisateurs à ajuster les quantités des produits dans leur panier avant la finalisation de la commande.
   - Permet aux utilisateurs de retirer des articles de leur panier, offrant une flexibilité dans le processus d'achat.
   - Guide les utilisateurs à travers les étapes nécessaires pour finaliser et confirmer leur commande.
2.2.8. Adresse :
   - Permet aux utilisateurs de choisir parmi leurs adresses enregistrées lors du processus de commande.
   - Autorise les utilisateurs à inclure de nouvelles adresses dans leur profil.
   - Donne aux utilisateurs la possibilité de mettre à jour les détails de leurs adresses enregistrées.
   - Permet aux utilisateurs de retirer des adresses de leur profil.
2.2.9. Paiement :
   - Valider la commande en inscrivant les informations de paiement.
2.2.10. Général :
   - Établit des rôles distincts avec des autorisations spécifiques pour les visiteurs, les utilisateurs enregistrés et les administrateurs.

## Structure du Projet

```
/                   # Racine du projet
|-- /App            # Dossier pour les fichiers liés à l'application
|   |-- /Helpers     # Fichier des helpers pour simplifier le code
|   |-- /Controllers # Contrôleurs du modèle MVC
|   |-- /Models      # Modèles du modèle MVC
|   |-- /Views       # Vues du modèle MVC
|   |-- /Application # Class définissant les méthodes lié à l'paplication
|   |-- /Routeur     # Class liant les url à des méthodes de controllers
|-- /Public         # Dossier public accessible via le navigateur
|   |-- /Syles      # Fichiers CSS
|   |-- /Scripts    # Fichiers JavaScript
|   |-- /Images     # Images et fichiers multimédias
|   |-- /Font	    # Fichiers de font
|-- .htaccess       # Fichier permettant de rediriger les requêtes vers index.php
|-- autoload.php    # Fichier permettant l'auto-inclusion des fichiers dans index.php
|-- README.md       # Documentation du projet
|-- index.php       # Point d'entrée de l'application
```

## Prérequis

- Serveur PHP
- Serveur MySQL
- Navigateur Web

## Installation

1. Transférer le projet vers un environnement d'interprétation PHP
2. Configurez la base de données en l'important sous le nom "u968260774_delicor"
3. Ouvrez le projet dans votre navigateur.

## Contributeurs

- Menou Clément
- Nardelli Maxime

## Licence

Apache

---