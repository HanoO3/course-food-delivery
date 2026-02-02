<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    //...
 
public function boot(): void
{
     Schema::defaultStringLength(191);

     Gate::before(fn () => true);
}
    // public function boot(): void
    // {
    //     $this->registerGates();
    // }
 
    // protected function registerGates(): void
    // {
    //     try {
    //         foreach (Permission::pluck('name') as $permission) {
    //             Gate::define($permission, function ($user) use ($permission) {
    //                 return $user->hasPermission($permission);
    //             });
    //         }
    //     } catch (\Exception $e) {
    //         info('registerPermissions(): Database not found or not yet migrated. Ignoring user permissions while booting app.');
    //     }
    // }
}