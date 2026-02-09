<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $this->createAdminRole();
        $this->createVendorRole(); 
    }

    protected function createRole(RoleName $role, Collection $permissions): void
    {
        $newRole = Role::create(['name' => $role->value]);
        $newRole->permissions()->sync($permissions);
    }

    protected function createAdminRole(): void
    {
        $permissions = Permission::query()
            ->where('name', 'like', 'user.%')
            ->orWhere('name', 'like', 'restaurant.%')
            ->pluck('id');

        $this->createRole(RoleName::ADMIN, $permissions);
    }

    protected function createVendorRole(): void 
    { 
        $permissions = Permission::query()
            ->whereIn('name', [
                'restaurant.viewAny',
                'restaurant.view',
                'restaurant.create',
                'restaurant.update',
                'restaurant.delete',
               
            ])
            ->pluck('id');

        $this->createRole(RoleName::VENDOR, $permissions);
    }
}