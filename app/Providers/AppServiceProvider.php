<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        //@additional https://medium.com/@dev.gowa/register-dengan-verifikasi-email-menggunakan-laravel-part-1-c468d859856f
        // --> Agar bisa string di database lebih dari 191 karakter

        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        //@endAddtional
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
