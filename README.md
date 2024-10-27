# Vue d'ensemble
Cette application , développée avec Symfony (PHP 7) et intégrée à WordPress, est conçue pour faciliter la gestion des relations clients. Elle permet de gérer les projets d'investissement, d'export et de sourcing, tout en automatisant les interactions avec les comptes et les partenaires.

# Fonctionnalités

## Gestion des Comptes et Partenaires
- Suivi du statut des comptes (installés ou non au Maroc)
- Historisation des interactions avec les comptes et partenaires
- Qualification des contacts en tant que Compte, Partenaire ou autre profil

## Gestion des Contacts
- Champs détaillés pour les informations de contact (nom, email, téléphone, langues).
- Sélection de profil avec des options pour Compte, Partenaire ou autre.
- Téléchargement des contacts et marquage avec des statuts d'exclusivité.

## Gestion de Projets
- Création de projets pour l’investissement, l'export ou le sourcing en fonction de l'intérêt du compte.
- Étapes du funnel de projet : Intérêt, Décision et Exécution.
- Téléversement de documents et options de téléchargement pour les fichiers de projet.
- Mise à jour automatique du statut selon les étapes du projet.

## Gestion des Événements
- Création et catégorisation des événements (investissement, export ou autres).
- Suivi de la participation et organisation des contacts liés aux événements.
- Extraction et options de téléchargement des listes d'événements par type de participation.

## Automatisation du Marketing
- Envois automatiques d'emails et notifications pour les comptes/projets en stagnation.
- Système de notification pour la qualification des nouveaux contacts et les demandes de suivi.
- Actions automatisées de requalification des comptes basées sur l'inactivité.

## Sécurité
- Sauvegarde des données et infrastructure sécurisée.
- Authentification à double facteur pour l'accès des utilisateurs.
- Conformité RGPD pour la confidentialité et la sécurité des données.

# Installation
- Clonez le dépôt.
- Installez les dépendances avec Composer : composer install
- Configurez les variables d'environnement dans .env pour la base de données.
- Exécutez les migrations pour configurer la base de données : php bin/console doctrine:migrations:migrate
