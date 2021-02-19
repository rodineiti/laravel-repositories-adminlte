<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Institution;
use App\Models\OfferType;
use App\Models\TeachingUnit;
use App\Models\Discipline;
use App\Models\Subject;
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

        // passe parameters to full path admin.tests.*
        view()->composer(
            ['admin.tests.*'],
            function ($view) {
                $view->with('institutions', Institution::all());
                $view->with('teaching_units', TeachingUnit::all());
                $view->with('offer_types', OfferType::all());
                $view->with('disciplines', Discipline::all());
                $view->with('subjects', Subject::all());
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
