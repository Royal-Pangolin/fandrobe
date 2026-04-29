# Fandrobe E-commerce Project Instructions

## Project Overview
Fandrobe is an e-commerce platform where artists sell official merchandise featuring their work. For detailed project description, installation guide, and authors, see [README.md](README.md).

## Build and Test Commands
- **Setup**: `composer run setup` (installs dependencies, generates APP_KEY, runs migrations, npm install)
- **Development**: `composer run dev` (starts Laravel server on port 8000, queue listener, log tail, Vite dev server)
- **Test**: `composer run test` (runs PHPUnit tests with SQLite in-memory database)
- **Individual commands**:
  - `php artisan serve` - Start Laravel development server
  - `npm run dev` - Start Vite in watch mode
  - `npm run build` - Build production assets
  - `php artisan migrate` - Run database migrations
  - `php artisan seed` - Run database seeders
  - `php artisan tinker` - Interactive PHP shell

## Architecture Overview
- **Framework**: Laravel 12 with Fortify authentication
- **Structure**: MVC pattern with 25 domain models
- **Frontend**: Blade templates with Bootstrap 5, Vite for asset compilation
- **Database**: Relational design with foreign key constraints, Spanish migration names
- **Authentication**: Fortify with email verification, role-based access (admin/customer)
- **Key domains**: Products (with variants, images, reviews), Orders (with payments, shipments), Artists, Categories

## Project Conventions
- **Language**: Spanish for routes (/productos, /pedidos, /artistas), session keys, flash messages, and comments
- **Validation**: Use array syntax in controllers (no FormRequest classes yet)
- **Database operations**: Wrap admin changes in `DB::transaction()` with try/catch
- **Relationships**: Always use `->with()` for eager loading to prevent N+1 queries
- **Slugs**: Auto-generate from name using `Str::slug()`
- **Role checks**: `auth()->user()->role->name === 'admin'` (consider using Gates/Policies)
- **Cart logic**: ShoppingCart with status 'active/inactive', manual conversion to Order

## Potential Pitfalls
- **Testing**: Only example test exists - critical features (orders, payments) untested
- **Authorization**: String-based role checks are fragile; implement proper policies
- **Validation**: Inline validation in controllers violates DRY; extract to FormRequest classes
- **Concurrency**: Cart-to-order conversion uses individual inserts; potential race conditions
- **Images**: ProductImage model expects URL but no upload/storage logic visible
- **API**: No JSON endpoints; only Blade views (limits SPA/mobile support)
- **Environment**: SQLite default in .env.example; production likely needs MySQL/PostgreSQL

## Key Files and Directories
- **Routes**: [routes/web.php](routes/web.php) - All application routes with Spanish slugs
- **Models**: [app/Models/](app/Models/) - Domain entities (Product, Order, User, etc.)
- **Controllers**: [app/Http/Controllers/](app/Http/Controllers/) - Frontend controllers; Admin/ subdirectory for admin features
- **Migrations**: [database/migrations/](database/migrations/) - Database schema (30+ migrations)
- **Seeders**: [database/seeders/](database/seeders/) - Test data seeding
- **Views**: [resources/views/](resources/views/) - Blade templates organized by feature
- **Auth**: [app/Providers/FortifyServiceProvider.php](app/Providers/FortifyServiceProvider.php) - Authentication configuration

## Development Workflow
1. Clone repository
2. Run `composer run setup` for initial setup
3. Run `composer run dev` for development
4. Access at http://localhost:8000
5. Admin user: admin@fandrobe.com / password
6. Test users: pablo@fandrobe.com, maria@fandrobe.com / password

For more details, see [README.md](README.md).</content>
<parameter name="filePath">c:\xampp\htdocs\fandrobe\AGENTS.md
