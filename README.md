# 🎫 Helpdesk Ticketing System

Application web complète de gestion de tickets (Helpdesk) développée avec **Laravel 12** et **MySQL**. Ce projet permet aux employés de signaler des incidents informatiques et aux administrateurs de les traiter efficacement.

## ✨ Fonctionnalités Principales

- **Authentification sécurisée** : Connexion par nom complet et mot de passe (sans inscription publique).
- **Gestion des rôles** : Admin (gestion globale) et Employé (création de tickets).
- **Gestion des tickets** : Création, assignation, résolution et archivage automatique.
- **Conversation en temps réel** : Chat intégré sur chaque ticket.
- **Base de connaissances** : Archivage des solutions aux problèmes récurrents.
- **Tableau de bord** : Statistiques et graphiques dynamiques (Chart.js).
- **Notifications** : Cloche de notification pour les nouveaux messages.
- **Pièces jointes** : Upload et téléchargement de fichiers.

## 🛠️ Stack Technique

- **Backend** : Laravel 12, PHP 8.2
- **Base de données** : MySQL
- **Frontend** : Blade, Bootstrap 5, Chart.js

## 🚀 Installation Locale

```bash
# 1. Cloner le projet
git clone https://github.com/ZouhirJabah/helpdesk-ticketing-app.git

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances front-end
npm install

# 4. Copier le fichier d'environnement
cp .env.example .env

# 5. Générer la clé d'application
php artisan key:generate

# 6. Configurer la base de données dans .env
# DB_DATABASE=ticketing_db
# DB_USERNAME=root
# DB_PASSWORD=

# 7. Lancer les migrations
php artisan migrate

# 8. Créer le lien symbolique pour les fichiers
php artisan storage:link

# 9. Lancer le serveur
php artisan serve
