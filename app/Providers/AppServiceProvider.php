<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Issue with MySQL < 5.7
        Schema::defaultStringLength(191);

        // Share current user.
        Inertia::share('user', static function ()
        {
            if ($user = auth()->user()) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                ];
            }
        });
    }

}
