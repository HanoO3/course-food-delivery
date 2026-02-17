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
        $this->createCustomerRole(); 
        $this->createStaffRole();
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
              ->orWhere('name', 'like', 'category.%')
              ->orWhere('name', 'like', 'product.%')
              ->orWhereIn('name', [
                'user.create',
        ])
            ->pluck('id');
       
        $this->createRole(RoleName::VENDOR, $permissions);
    }

    protected function createCustomerRole(): void 
{ 
    $permissions = Permission::whereIn('name', [ 
        'cart.add',
        'order.viewAny',
        'order.create',
    ])->get();
 
    $this->createRole(RoleName::CUSTOMER, $permissions); 
} 

public function createStaffRole() 
{
    $this->createRole(RoleName::STAFF, collect());
}
}