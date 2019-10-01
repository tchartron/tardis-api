<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
// use App\Services\Oauth\GitlabProvider;
// use Laravel\Socialite\SocialiteManager;
use App\Services\Oauth\GitlabAuthManager;
use Laravel\Socialite\SocialiteServiceProvider;

class GitlabAuthServiceProvider extends SocialiteServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Laravel\Socialite\Contracts\Factory', function ($app) {
            return new GitlabAuthManager($app);
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
