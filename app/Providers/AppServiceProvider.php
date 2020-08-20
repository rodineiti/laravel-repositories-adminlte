<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        // passe parameters to full path admin.products.*
        view()->composer(
            ['admin.products.*'],
            function ($view) {
                $view->with('categories', Category::all());
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('menu_site', Page::all());

        // settings
        View::share('settings', (new Setting())->getSettings());
    }
}
