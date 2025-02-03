Symfony Project Generator

Symfony Project Generator est un outil graphique permettant de créer et configurer rapidement un projet Symfony personnalisé. Grâce à une interface intuitive, il vous permet de définir les paramètres essentiels dès le départ, vous faisant gagner un temps précieux dans vos développements.

🚀 Fonctionnalités

Création rapide de projets Symfony monolithiques.

Choix de la version PHP et Symfony (dernière version compatible).

Sélection de la base de données (MySQL ou PostgreSQL).

Configuration de l’authentification (Security Component, avec d’autres options à venir).

Installation automatique des dépendances (sélection manuelle ou via l’option "Web App").

Gestion des projets via Docker : lancement et suivi de l’état des services.

Interface graphique pour gérer et modifier facilement les entités, contrôleurs, formulaires, et templates Twig.

📦 Installation

1️⃣ Cloner le dépôt

git clone https://github.com/votre-utilisateur/symfony-project-generator.git
cd symfony-project-generator

2️⃣ Installer les dépendances

composer install
npm install

3️⃣ Lancer l’application

symfony server:start

Ou avec Docker :

docker-compose up -d

🛠 Contribution

Les contributions sont les bienvenues ! Si vous souhaitez ajouter des fonctionnalités ou améliorer l’outil, consultez le fichier CONTRIBUTING.md pour connaître les bonnes pratiques à suivre.

🐟 Licence

Ce projet est sous licence MIT.
