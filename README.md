﻿# Edifis-Pro

## 🚀 Installation du projet Symfony

### ✅ Prérequis
Avant de commencer, assure-toi d'avoir installé :
- **PHP 8.1+** ([Télécharger PHP](https://www.php.net/downloads))
- **Composer** ([Télécharger Composer](https://getcomposer.org/download/))
- **Symfony CLI** ([Télécharger Symfony](https://symfony.com/download))
- **Git** ([Télécharger Git](https://git-scm.com/downloads))
- **MySQL** (via XAMPP, WAMP ou MariaDB)

---

## 🛠️ Étapes d'installation

### 1️⃣ **Cloner le projet**
```bash
git clone https://github.com/ton-organisation/edifis-pro.git
cd edifis-pro
```

### 2️⃣ **Installer les dépendances**
```bash
composer install
```

### 3️⃣ **Configurer l'environnement**
```bash
cp .env .env.local
```
Ensuite, modifie `.env.local` pour y ajouter les informations de connexion à la base de données :
```ini
DATABASE_URL="mysql://tonidentifiant:@127.0.0.1:3306/nom_de_ta_base"
```
Remplace **`nom_de_ta_base`** par le nom réel de la base.

### 4️⃣ **Créer la base de données**
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5️⃣ **Compiler les assets (si applicable)**
Si Webpack Encore est utilisé :
```bash
npm install
npm run dev
```

### 6️⃣ **Démarrer le serveur Symfony**
```bash
symfony server:start
```
Si Symfony CLI n'est pas installé, utilise :
```bash
php -S 127.0.0.1:8000 -t public
```
Accède ensuite à :
```
http://127.0.0.1:8000
```

---

## ✅ Commandes utiles
- Vérifier la configuration Symfony :
  ```bash
  symfony check:req
  ```
- Voir les routes disponibles :
  ```bash
  php bin/console debug:router
  ```
- Lancer les tests unitaires :
  ```bash
  php bin/phpunit
  ```

---

## 🎯 Résumé des commandes
```bash
git clone https://github.com/ton-organisation/edifis-pro.git
cd edifis-pro
composer install
cp .env .env.local
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
symfony server:start
```
Puis, ouvre **http://127.0.0.1:8000** dans ton navigateur. 🚀

---

## 🛠️ Support & Contact
Si tu rencontres un problème, vérifie les logs :
```bash
tail -f var/log/dev.log
```
Ou contacte le responsable du projet.

🎉 **Bon développement !**
