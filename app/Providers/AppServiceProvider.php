<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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

    //A Gate in Laravel is a way to define authorization logic for actions that aren’t tied to a specific model. It lets you check if a user is allowed to do something, like visit an admin page.


    public function boot(): void
    {
        Gate::define('visitAdminPages',function($user){
            return $user->isAdmin === 1;
        });
    }
}
