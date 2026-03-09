# Laravel 12 + Vue 3 (Inertia) + Spatie Roles Boilerplate

Because your machine does not currently have `PHP`, `Composer`, or `Node.js` installed, a full Laravel project (with all vendor/node_modules dependencies) could not be instantly generated. 

Instead, I have created the core customized files you will need to implement Role Management once you have your environment set up.

## Prerequisites
1. Install [PHP](https://windows.php.net/download/)
2. Install [Composer](https://getcomposer.org/download/)
3. Install [Node.js](https://nodejs.org/en)

---

## Installation Steps (Run these in your terminal)

**1. Create the new Laravel project:**
```bash
composer create-project laravel/laravel my-admin-panel
cd my-admin-panel
```

**2. Install Laravel Breeze (Vue / Inertia stack):**
```bash
composer require laravel/breeze --dev
php artisan breeze:install vue
```

**3. Install Spatie Laravel Permission:**
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

---

## Applying This Boilerplate

Once you have generated the project using the steps above, copy the files from this boilerplate directly into your new Laravel project folder:

1. **`app/Models/User.php`** 
   - Replaces the default `User.php`. Adds the `HasRoles` trait.
2. **`app/Http/Controllers/RoleController.php`**
   - Place this in `app/Http/Controllers/`. Manages the Vue 3 backend API endpoints.
3. **`database/seeders/RolesAndPermissionsSeeder.php`**
   - Place this in `database/seeders/`.
   - Update your `database/seeders/DatabaseSeeder.php` to call this: `$this->call(RolesAndPermissionsSeeder::class);`
4. **`routes/web.php`**
   - Replaces `routes/web.php`. Registers the roles endpoints.
5. **`resources/js/Pages/Roles/Index.vue`**
   - Create the `Roles` directory inside `resources/js/Pages/` and place this file inside it.

## Final Steps

Run migrations and seed the database to apply the roles:
```bash
php artisan migrate:fresh --seed
```

Compile the Vue 3 frontend:
```bash
npm install
npm run dev
```

Serve the Laravel backend (open a new terminal tab):
```bash
php artisan serve
```

You can now navigate to `http://localhost:8000/roles` and log in using the seed credentials (`superadmin@example.com` / `password`).
