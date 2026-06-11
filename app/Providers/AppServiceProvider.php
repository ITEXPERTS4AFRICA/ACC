<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $pages = Page::all();
        $pagesByKey = $pages->keyBy('key');
        view()->share([
            'page' => $pagesByKey,
        ]);
    }
}
