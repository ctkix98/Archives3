# 🚴 Histoire Interactive – Le Tour de France

Ce projet est une application web interactive en **Laravel 12 + Vue 3 SPA**, où l'utilisateur suit une aventure à choix multiples dans l’univers du cyclisme et du Tour de France.  
Le joueur peut créer un compte, choisir une histoire, faire des choix à chaque chapitre, et atteindre la fin.

---

## 🧰 Technologies utilisées

- **Laravel 12**
- **Vue.js 3 SPA** (Single Page Application)
- **Vite** (compilation front)
- **Breeze** (authentification)
- **Sanctum** (gestion de session via cookies)
- **Tailwind CSS** (design responsive avec classes utilitaires)
- **SQLite** (base de données simple pour test/dev)

---

## 📦 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/ton-user/ton-repo.git
cd ton-repo
```

### 2. Installer les dépendances PHP et JS
```bash
composer install
composer require laravel/sanctum
npm install
```

### 3. Copier et configurer .env
```bash
cp .env.example .env
```

Ensuite, configurer la base de données, dans le fichier .env
```bash
DB_CONNECTION=sqlite
```

### 4. Créer un nouveau fichier pour la base de données
```bash
touch database/database.sqlite
```

### 5. Générer la clé d’application
```bash
php artisan key:generate
```

### 6. Remplir la base de données des histoires
```bash
# Exécuter les migrations
php artisan migrate

# Lancer le seeder
php artisan db:seed --class=StorySeeder
```

### 7. Lancer l'application
```bash
# Generate application key
composer run dev
```

## Fonctionnalités principales
### ✅ Création de compte & connexion via Vue + Laravel Breeze
### ✅ Navigation dans une histoire à chapitres et choix
### ✅ API REST versionnée (/api/v1/chapters, /api/v1/stories)
### ✅ Interface responsive avec les couleurs du Tour de France
### ✅ Déconnexion propre (avec window.location.reload() pour les cookies CSRF)
### ✅ Gestion d’erreurs 404 personnalisée

## Aperçu du projet
### Page de login
### Page d’accueil avec les histoires disponibles
### Vue de chapitre avec texte et choix
### Bouton de retour à l’accueil à tout moment
### Footer global
### Navigation SPA fluide
