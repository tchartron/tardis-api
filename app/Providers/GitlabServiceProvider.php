<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Gitlab;

class GitlabServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Gitlab::class, function() {
            return new Gitlab();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
