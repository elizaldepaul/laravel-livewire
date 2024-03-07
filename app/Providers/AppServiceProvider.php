<?php

namespace App\Providers;

use App\Livewire\IndexComponent;
use Illuminate\Support\ServiceProvider;
use App\Livewire\UserDashboard;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('user-dashboard', UserDashboard::class);
        Livewire::component('index-component', IndexComponent::class);
    }
}
