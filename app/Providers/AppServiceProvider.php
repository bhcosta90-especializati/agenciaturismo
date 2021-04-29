<?php

namespace App\Providers;

use Carbon\Carbon;
use FilesystemIterator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        Str::macro('number_format', function ($str) {
            return "R$ " . number_format($str, 2, ',', '.');
        });

        Str::macro('date', function ($str) {
            return new Carbon($str);
        });

        $iterator = new FilesystemIterator(__DIR__ . "/../Repositories/");
        foreach ($iterator as $file) {
            $fileName = $file->getFilename();
            $extension = substr($fileName, -4);
            if ($extension == '.php') {
                $getClass = "App\\Repositories\\" . substr($fileName, 0, -4);
                $getContract = "App\\Repositories\\Contracts\\" . substr($fileName, 0, -14) . "Contract";
                $this->app->singleton($getContract, $getClass);
            }
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
