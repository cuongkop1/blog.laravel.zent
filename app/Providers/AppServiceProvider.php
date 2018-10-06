<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Category;
use App\Tag;
use App\Post;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         /**
         * share categories
         */
         // if (!\App::runningInconsole()) {
            if(Schema::hasTable('categories')){
                View::share('categories', Category::all());
            }
            if(Schema::hasTable('tags')){
                View::share('tags', Tag::all());
            }
            if(Schema::hasTable('posts')){
                View::share('posts', Post::all());
            }
            if(Schema::hasTable('users')){
                View::share('users', User::all());
            }
         //    View::share('lastpost', Post::OrderBy('id','desc')->take(env('LASTPOST', ''))->get());
         // }
        
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
