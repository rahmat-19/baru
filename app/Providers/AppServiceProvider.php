<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Luilliarcec\LaravelUsernameGenerator\Facades\Username;

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
        // Username::withTrashed()
        //     ->setDriver('name') // By default 'name' is used so you can omit this if you like.
        //     ->setCase('lower') // By default 'lower' is used so you can omit this if you like.
        //     ->setModel(User::class) // By default 'App\Models\User' is used so you can omit this if you like.
        //     ->setColum('username'); // By default 'username' is used so you can omit this if you like.

        // Username::withTrashed()
        //     // If you are using another namespace for your User model, set it here.
        //     ->setModel('App\Models\User');
        Username::withoutTrashed()
            ->setDriver('email')
            ->setCase('lower')
            ->setModel(User::class)
            ->setColum('username');
    }
}
