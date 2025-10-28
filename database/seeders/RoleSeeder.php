<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'can access roles']);
        Permission::create(['name' => 'can access permissions']);
        Permission::create(['name' => 'can add roles']);
        Permission::create(['name' => 'can edit roles']);
        Permission::create(['name' => 'can manage roles']);
        Permission::create(['name' => 'can delete roles']);
        Permission::create(['name' => 'can make permissions']);
        Permission::create(['name' => 'can edit permissions']);
        Permission::create(['name' => 'can delete permissions']);
        Permission::create(['name' => 'can access users']);
        Permission::create(['name' => 'can create users']);
        Permission::create(['name' => 'can edit users']);
        Permission::create(['name' => 'can delete users']);
        Permission::create(['name' => 'can access temuan']);
        Permission::create(['name' => 'can access perbaikan']);
        Permission::create(['name' => 'can choose departments']);
        Permission::create(['name' => 'can delete data']);

        $roleSuperadmin = Role::create(['name' => 'Superadmin']);
        $roleAuditor    = Role::create(['name' => 'Auditor']);
        $roleAuditee    = Role::create(['name' => 'Auditee']);
        $roleManager    = Role::create(['name' => 'Manager']);

        // Superadmin: get all permissions
        $roleSuperadmin->givePermissionTo(Permission::all());

        // Auditor: get all except 'can access perbaikan' and 'can access users'
        $auditorPermissions = Permission::whereNotIn('name', [
            'can access perbaikan',
            'can access users',
        ])->get();
        $roleAuditor->givePermissionTo($auditorPermissions);

        // Auditee: only 'can access perbaikan'
        $roleAuditee->givePermissionTo('can access perbaikan');

        $roleManager->givePermissionTo('can choose departments');
    }
}
