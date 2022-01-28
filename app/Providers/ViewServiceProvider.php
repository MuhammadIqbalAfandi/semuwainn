<?php

namespace App\Providers;

use App\Models\Copyright;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('components.dashboard-layout.footer', function ($view) {
            $copyright = Copyright::get()->first();
            $copyright = $copyright->copyright ?? '-';
            $view->with('copyright', $copyright);
        });

    }
}
