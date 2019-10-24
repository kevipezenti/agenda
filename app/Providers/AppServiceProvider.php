<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

        // $this->app->bind('App\Repositories\AgendaInterface','App\Repositories\AgendaRepository');
    }

    // public function boot(){
    //     $this->app->bind(App\Repositories\AgendaInterface::class,App\Repositories\AgendaRepository::class);
    // }
}
