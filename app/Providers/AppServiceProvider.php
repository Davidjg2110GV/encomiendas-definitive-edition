<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Encomienda;
use App\Policies\EncomiendaPolicy;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
    Encomienda::class => EncomiendaPolicy::class,
];
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
        //
    }
}
