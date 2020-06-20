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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories =  \App\Category::all();
        $products =  \App\Product::where('display',1)->get();
        //view()->share('nav_categories',$categories);
        view()->share([
            'nav_categories' => $categories,
            'products' => $products,
        ]);
    }
}
