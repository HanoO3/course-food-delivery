<?php

namespace App\Models;

use App\Enums\RoleName;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleName::ADMIN);
    }

    public function isVendor(): bool
    {
        return $this->hasRole(RoleName::VENDOR);
    }

    public function isStaff()
    {
        return $this->hasRole(RoleName::STAFF);
    }

    public function isCustomer()
    {
        return $this->hasRole(RoleName::CUSTOMER);
    }

    public function hasRole(RoleName $role): bool
    {
        return $this->roles()->where('name', $role->value)->exists();
    }

    public function permissions(): array
    {
        return $this->roles()->with('permissions')->get()
            ->map(function ($role) {
                return $role->permissions->pluck('name');
            })
            ->flatten()
            ->values()
            ->unique()
            ->toArray();
    }

    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions(), true);
    }

    public function restaurant(): HasOne
    {
        return $this->hasOne(Restaurant::class, 'owner_id');
    }

    public function orders(): HasMany
    {
    return $this->hasMany(Order::class, 'customer_id');
    }
}