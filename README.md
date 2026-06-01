# :art: Fandrobe - Artist Merchandise Marketplace :shopping_cart:

- [:clipboard: Project Summary](#clipboard-project-summary)
- [:wrench: Installation](#wrench-installation)
  - [:zero: Prerequisites](#zero-prerequisites)
  - [:one: Clone the Repository](#one-clone-the-repository)
  - [:two: Setup the Project](#two-setup-the-project)
  - [:three: Run the Application](#three-run-the-application)
  - [:four: Access the App](#four-access-the-app)
  - [:five: Stop the Application](#five-stop-the-application)

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


---

## :wrench: Installation

### :zero: Prerequisites

- [Git](https://git-scm.com/)
- [Docker Desktop](https://www.docker.com/products/docker-desktop) (includes Docker Compose)

No need to install PHP, MySQL, Node.js, or Composer locally — everything runs inside Docker containers.

### :one: Clone the Repository

```bash
git clone https://github.com/Royal-Pangolin/fandrobe.git
cd fandrobe
```

### :two: Setup with Docker

#### 1. Start the Docker containers

```bash
docker compose up -d
```

This starts all services: Laravel app, Nginx web server, MySQL database, MongoDB, Redis, and phpMyAdmin.

#### 2. Install PHP dependencies

```bash
docker compose exec app composer install
```

#### 3. Create .env file (if it doesn't exist)

```bash
docker compose exec app cp .env.example .env
```

#### 4. Generate Laravel key

```bash
docker compose exec app php artisan key:generate
```

#### 5. Create storage symlink for public file access

```bash
docker compose exec app php artisan storage:link
```

#### 6. Run database migrations

```bash
docker compose exec app php artisan migrate
```

#### 7. Seed the database with test data

```bash
docker compose exec app php artisan migrate --seed
```

This creates sample artists, products, categories, and test user accounts.

#### 8. Fix file permissions (critical for Docker)

```bash
docker compose exec app chmod -R 775 /var/www/storage /var/www/bootstrap/cache
docker compose exec app chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
```

#### 9. Install frontend dependencies

```bash
docker compose exec app npm install
```

### :three: Run the Application

Start all services in the background:

```bash
docker compose up -d
```

Then in separate terminals, run:

**Terminal 1 - Vite development server (asset compilation with HMR)**:
```bash
docker compose exec app npm run dev
```

**Terminal 2 - Laravel development server**:
```bash
docker compose exec app php artisan serve
```

**Terminal 3 - Queue worker (for async jobs like emails)**:
```bash
docker compose exec app php artisan queue:listen --tries=1 --timeout=0
```

**Alternative - Run everything at once** (if you have `npm i -g concurrently` installed):
```bash
docker compose exec app composer run dev
```

### :four: Access the App

Open your browser and navigate to:
- **App**: [http://localhost:8000](http://localhost:8000)
- **phpMyAdmin** (database UI): [http://localhost:8080](http://localhost:8080)

#### Test Accounts (after seeding)

- **Admin**: `admin@fandrobe.com` / `password`
- **Customer 1**: `pablo@fandrobe.com` / `password`
- **Customer 2**: `maria@fandrobe.com` / `password`

### :five: Stop the Application

```bash
docker compose down
```

To also remove volumes (database data):
```bash
docker compose down -v
```

### :warning: Important Notes

- **Database port inside container**: Always use `3306` in `.env` (even though the host port is `3307`)
- **Logs file permissions**: If you see permission errors writing to `storage/logs/laravel.log`, run the permissions fix from step 8
- **Vite assets**: The Vite dev server must be running for CSS/JS changes to reflect in real-time
- **Queue worker**: Long-running tasks (like sending emails) won't process unless the queue worker is running

---

**:sparkles: Now you're ready to explore Fandrobe locally!**
