# 🌐 Laravel 12 – Plateforme de Discussion en Temps Réel

Bienvenue sur **OCA**, un site web développé avec Laravel 12. Il s'agit d'une plateforme sociale de discussion sécurisée, multilingue, et orientée temps réel grâce à l'utilisation des Websockets. Ce site web est un projet personnel étudiant dans le but d'apprendre de nouveaux outils.

---

## 🛡️ Authentification & Sécurité

Notre système d'authentification inclut :

- **Connexion avec validation par email (2FA)** : Après inscription avec login/mot de passe, un email est envoyé à l'utilisateur pour confirmer son identité.
- **Modification sécurisée** du mot de passe ou du pseudonyme depuis les paramètres du compte.
- Gestion des sessions et protections CSRF intégrées grâce à Laravel.

---
## 📡 Websockets & Communication en Temps Réel

Grâce à **Laravel Echo** et **Laravel Reverb**, la plateforme bénéficie d’une communication en **temps réel** totalement intégrée à l’écosystème Laravel :

- 💬 Les **messages** dans les groupes sont envoyés et reçus **instantanément**, sans rechargement de page.
- 🔄 Les **groupes** se mettent à jour dynamiquement dès qu’un changement survient (nouveau groupe, renommage, suppression…).
- 👀 Les **messages système** (utilisateur ajouté, expulsé, quittant le groupe, etc.) sont automatiquement diffusés à tous les membres du groupe.

Reverb agit ici comme le **serveur WebSocket natif de Laravel**, sans dépendances externes comme Pusher, permettant des performances élevées et un contrôle total sur la logique des événements.


## 👥 Groupes de Discussion

Les utilisateurs peuvent :

- ✅ Créer un groupe de discussion.
- ➕ Ajouter d'autres membres au groupe.
- 🔨 En tant que modérateur du groupe :
  - Expulser des membres.
  - Gérer les autorisations.
- 🚪 Quitter un groupe à tout moment.
- ✨ Voir les **messages système** pour toutes les actions importantes (entrée, sortie, expulsion…).

Chaque message dans un groupe contient :
- L’**auteur** du message.
- L’**heure exacte** d’envoi.
- Le **contenu** du message.

---

## 🧑‍💼 Espace Administrateur

Une section dédiée aux **admins** est disponible avec les fonctionnalités suivantes :

- 🔨 **Bannir** des utilisateurs.
- 🗑️ **Supprimer** des comptes définitivement.
- 📰 **Créer des articles** qui seront ensuite publiés et visibles par tous les utilisateurs du site.

---

## 📊 Statistiques & Dashboard

Une page dédiée permet de visualiser des **statistiques avancées** sur la plateforme, incluant (exemples à adapter) :

- Nombre de groupes actifs
- Messages envoyés par heure
- Utilisateurs en ligne
- Évolution des inscriptions

Cette page est idéale pour le suivi de l'activité du site.

---

## 🌍 Internationalisation

Le site est **multilingue** et permet à l’utilisateur de choisir parmi les langues suivantes :

- 🇫🇷 Français
- 🇬🇧 Anglais
- 🇪🇸 Espagnol
- 🇨🇳 Chinois

L’implémentation des traductions est basée sur les fichiers `lang/`, ce qui rend **l’ajout de nouvelles langues simple et rapide**.

---

## ⚙️ Fonctionnalités Utilisateur

- 🧑 Modifier son **pseudo** ou **mot de passe**.
- 🔐 Authentification sécurisée avec double vérification par mail.
- 👥 Gérer ses groupes (créer, rejoindre, quitter).
- 💬 Messagerie en temps réel.
- 🌐 Choix de la langue d’affichage.

---

## 🚀 Stack Technique

- **Framework** : Laravel 12
- **Temps réel** : Laravel Echo + Reverb
- **Base de données** : PostgreSQL
- **Front-end** : Blade
- **Multilingue** : Laravel Localization
- **Statistiques** : Charts.js

---

## 📦 Installation & Lancement

```bash
git clone https://github.com/tonpseudo/tonprojet.git
cd tonprojet
composer install
cp .env.example .env
php artisan key:generate
# Configurer votre .env (DB, Mail, Pusher...)
php artisan migrate
php artisan serve
