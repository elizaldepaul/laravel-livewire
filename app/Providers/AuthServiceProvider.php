<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('createUser', function ($user) {
            return $user->role === 'admin'; // Only admins can create users
        });
        
        Gate::define('editUser', function ($user) {
            return $user->role === 'admin'; // Only admins can edit users
        });
        Gate::define('deleteUser', function ($user) {
            return $user->role === 'admin'; // Only admins can delete users
        });

    }
}
