<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;


class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
{
    $user = $request->user();

    return array_merge(parent::share($request), [
        'auth' => $user
            ? [
                'user' => [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $user->roles->first()?->name ?? null, 
                ],
                'permissions' => $request->user()?->permissions() ?? [], 
            ]
            : null,
        'flash' => [
    'success' => fn () => $request->session()->get('success'),
    'error'   => fn () => $request->session()->get('error'),
    'status'  => fn () => $request->session()->get('status'),


    'cart'   => session('cart', [ 
        'items'           => [],
        'total'           => 0,
        'restaurant_name' => '',
        'restaurant_id'   => '',
        'item_count'      => 0,
    ]),
],
    ]);
}
}
