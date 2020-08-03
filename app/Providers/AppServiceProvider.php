<?php

namespace App\Providers;

use View;
use App\Category;
use Illuminate\Support\ServiceProvider;
// use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // For all view files
        // View::share('name', 'Shihab Uddin Ahmed');

        //For specific view file
        // View::composer('front-end.home.home', function($view){
        //     $view->with('name', 'Shihab Uddin Ahmed');
        // });

        View::composer('front-end.includes.header', function($view){
            $view->with('categories', $categories = Category::where('publication_status', 1)->get());
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength('191');
    }
}
