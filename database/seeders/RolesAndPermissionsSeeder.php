<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions based on common admin tasks
        $permissions = [
            'manage users',
            'manage sub-admins',
            'manage roles',
            'manage content',
            'manage settings',
            'view audit logs'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // create roles and assign existing permissions
        $roleUser = Role::firstOrCreate(['name' => 'User']);
        // Users normally only have basic permissions or none specific to the admin panel.

        $roleSubAdmin = Role::firstOrCreate(['name' => 'Sub-Admin']);
        $roleSubAdmin->givePermissionTo(['manage content', 'view audit logs']);

        $roleAdmin = Role::firstOrCreate(['name' => 'Admin']);
        $roleAdmin->givePermissionTo([
            'manage users',
            'manage content',
            'view audit logs'
        ]);

        $roleSuperAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $superAdmin = User::factory()->create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password')
        ]);
        $superAdmin->assignRole($roleSuperAdmin);

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $admin->assignRole($roleAdmin);
    }
}
