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
- Medina, Alberto
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

Follow these steps to set up and run the application locally.

### :zero: Prerequisites

- [Git](https://git-scm.com/)
- [PHP 8.2+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Node.js 18+](https://nodejs.org/) (for frontend assets)
- [MySQL](https://www.mysql.com/) (database)

---

### :one: Clone the Repository

```bash
git clone https://github.com/Royal-Pangolin/fandrobe.git
cd fandrobe
```

### :two: Setup the Project

Run the setup script to install dependencies, configure the environment, and set up the database:

```bash
composer run setup
```

This command will:
- Install PHP dependencies via Composer
- Create `.env` file from `.env.example` if it doesn't exist
- Generate the application key
- Run database migrations
- Install Node.js dependencies
- Build frontend assets

**Note**: If you prefer manual setup, you can run these commands individually:
```bash
composer install
cp .env.example .env  # On Windows: copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

### :three: Seed the Database (Optional)

To populate the database with test data (artists, products, users):

```bash
php artisan seed
```

This will create sample data including test users for development.

### :four: Run the Application

Start the development server:

```bash
composer run dev
```

This will start:
- Laravel development server on port 8000
- Queue worker for background jobs
- Log monitoring
- Vite development server for assets

**Alternative**: Run services individually:
```bash
php artisan serve
php artisan queue:listen --tries=1 --timeout=0
php artisan pail --timeout=0
npm run dev
```

### :four: Access the App

Open your browser and navigate to [http://localhost:8000](http://localhost:8000)

**Test Accounts**:
- **Admin**: `admin@fandrobe.com` / `password`
- **Customer**: `pablo@fandrobe.com` / `password`
- **Customer**: `maria@fandrobe.com` / `password`

### :five: Stop the Application

Press `Ctrl + C` in the terminal to stop all running services.

---

**:sparkles: Now you're ready to explore Fandrobe locally!**

---
