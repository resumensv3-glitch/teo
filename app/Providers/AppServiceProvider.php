<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Gates por rol
        Gate::define('ver-admin', function (User $user){
            return $user->rol === 'admin';
        });

        Gate::define('ver-cajero', function (User $user){
            return $user->rol === 'cajero';
        });

        Gate::define('ver-bodeguero', function (User $user){
            return $user->rol === 'bodeguero';
        });

        // Módulos generales
        Gate::define('ver-ventas', function (User $user){
         return in_array($user->rol, ['admin', 'cajero']); // bodeguero ya no está
        });

        Gate::define('ver-inventario', function (User $user){
            return in_array($user->rol, ['admin', 'bodeguero']);
        });

        Gate::define('ver-usuarios', function (User $user){
            return $user->rol === 'admin';
        });
    }
}
