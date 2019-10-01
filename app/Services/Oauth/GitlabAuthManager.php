<?php

namespace App\Services\Oauth;

use App\Services\Oauth\GitlabProvider;
use Laravel\Socialite\SocialiteManager;

class GitlabAuthManager extends SocialiteManager
{
    protected function createGitlabwebDriver()
    {
        $config = $this->app['config']['services.gitlabweb'];

        return $this->buildProvider(
            GitlabProvider::class, $config
        );
    }
}
