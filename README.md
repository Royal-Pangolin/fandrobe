# :art: Fandrobe - Artist Merchandise Marketplace :shopping_cart:

- [:clipboard: Project Summary](#clipboard-project-summary)
- [:wrench: Installation](#wrench-installation)
  - [:zero: Prerequisites](#zero-prerequisites)
  - [:one: Clone the Repository](#one-clone-the-repository)
  - [:two: Install Dependencies](#two-install-dependencies)
  - [:three: Configure the Environment](#three-configure-the-environment)
  - [:four: Set Up the Database](#four-set-up-the-database)
  - [:five: Run the Application](#five-run-the-application)
  - [:six: Access the App](#six-access-the-app)

### :busts_in_silhouette: Authors

- Enrique Rojas, Pablo
- Medina Pérez, Alberto
- Sánchez Troncoso, Pablo

---

## :clipboard: Project Summary

Welcome to **Fandrobe**!  
This is an **e-commerce platform** built with **Laravel** where artists can sell official merchandise featuring their work. Fans can purchase authenticated, affordable products while artists monetize and promote their art.

**Original Idea**: An app that allows artists to sell their merchandise.  
Users can buy items with designs by their favorite artists, complete with a signature or seal that guarantees authenticity and respects intellectual property.

**Example**: As a painter, your painting might cost €10,000. A fan who follows you on social media loves your work but can't afford the original. You offer official merchandise like a phone case with your painting's design and your signature. The fan buys it, supporting you while getting an affordable piece of your art.

This project was developed as an assignment for the **Advanced Development Technologies (TAD)** course in our Bachelor's Degree program.

For technical details and development instructions, see [AGENTS.md](AGENTS.md).

---

## :wrench: Installation

Follow these steps to set up and run the application locally using **XAMPP**.

### :zero: Prerequisites

Make sure you have the following installed before proceeding:

- [Git](https://git-scm.com/)
- [XAMPP](https://www.apachefriends.org/) (includes PHP 8.2+ and MySQL)
- [Composer](https://getcomposer.org/)
- [Node.js 18+](https://nodejs.org/) and npm

> **Note:** After installing XAMPP, make sure **Apache** and **MySQL** are running from the XAMPP Control Panel before continuing.

---

### :one: Clone the Repository

Clone the project into XAMPP's `htdocs` directory (or any directory of your choice):

```bash
git clone https://github.com/Royal-Pangolin/fandrobe.git
cd fandrobe
```

---

### :two: Install Dependencies

Install PHP and Node.js dependencies:

```bash
composer install
npm install
```

---

### :three: Configure the Environment

Copy the example environment file and open it for editing:

```bash
cp .env.example .env   # On Windows: copy .env.example .env
```

Then update `.env` with your local settings. A typical configuration for XAMPP looks like this:

```env
APP_NAME=Fandrobe
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_SCHEME=null
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="noreply@fandrobe.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

> **Note:** XAMPP's default MySQL user is `root` with an empty password. If you have set a password, update `DB_PASSWORD` accordingly.

Next, generate the application key:

```bash
php artisan key:generate
```

---

### :four: Set Up the Database

Create a new database named `fandrobe` in MySQL. You can do this through **phpMyAdmin** (available at [http://localhost/phpmyadmin](http://localhost/phpmyadmin)) or via the MySQL CLI:

```sql
CREATE DATABASE fandrobe CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Then run the migrations to create all required tables:

```bash
php artisan migrate
```

#### Seed the Database (Optional)

To populate the database with sample data (artists, products, and test users):

```bash
php artisan db:seed
```

---

### :five: Run the Application

You will need **two terminals** running simultaneously — one for Laravel and one for Vite.

**Terminal 1 — Laravel development server:**

```bash
php artisan serve
```

**Terminal 2 — Vite development server (frontend assets):**

```bash
npm run dev
```

> **Alternatively**, if your project has a `composer run dev` script configured, you can use that to start all services at once:
> ```bash
> composer run dev
> ```

---

### :six: Access the App

Open your browser and navigate to [http://localhost:8000](http://localhost:8000)

**Test Accounts** (available after seeding):

| Role     | Email                  | Password   |
|----------|------------------------|------------|
| Admin    | `admin@fandrobe.com`   | `password` |
| Customer | `pablo@fandrobe.com`   | `password` |
| Customer | `maria@fandrobe.com`   | `password` |

---

**:sparkles: Now you're ready to explore Fandrobe locally!**
