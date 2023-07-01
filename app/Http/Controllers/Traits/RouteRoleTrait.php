<?php

namespace App\Http\Controllers\Traits;

trait RouteRoleTrait
{
    public function redirectViaRole($route)
    {
        $user = auth()->user();
        if ($user->hasRole('admin')) {
            return redirect(route('admin.dashboard'));
        } elseif (!$user->hasRole('user')) {
            return redirect(route('home.index'));
        } else {
            return redirect(route($route));
        }
    }
}
