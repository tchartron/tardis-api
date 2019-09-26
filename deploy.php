<?php
namespace Deployer;

$name   = 'Tardis website';
$server = 'ploutos.webexpertbusiness.net';
$path   = '/home/web/tardis';

require dirname (__FILE__) . '/vendor/autoload.php';

require 'recipe/laravel.php';
require 'recipe/slack.php';

// Project name
set('application', $name);

// Project repository
// set('repository', 'git@git.webexpertbusiness.net:web-expert-business/website.git');
set('repository', `git config --get remote.origin.url`);

// [Optional] Allocate tty for git clone. Default value is false.
// set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

// host('project.com')
//     ->set('deploy_path', '~/{{application}}');

host('production')
    ->hostname($server)
    ->user('deploy')
    ->forwardAgent()
    ->stage('production')
    ->set('deploy_path', $path . '/prod');

host('stage')
    ->hostname($server)
    ->user('deploy')
    ->forwardAgent()
    ->set('deploy_path', $path . '/stage');

set('slack_webhook', 'https://hooks.slack.com/services/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');
set('slack_text', '_{{user}}_ déploie `{{branch}}` en *{{target}}*');
set('slack_success_color', '#7ABA70');
set('slack_success_text', 'Déploiement en *{{target}}* réussi !');
set('slack_failure_text', 'Echec du déploiement en *{{target}}*');

// Tasks

task('env:create', function () {
    $output = run('if [ ! -f {{deploy_path}}/current/.env ]; then printf "APP_ENV=' . get('stage', 'stage') . '\nAPP_KEY=\nAPP_LOG_LEVEL=debug" >> {{deploy_path}}/current/.env && echo "Minimal .env file created"; fi');
    if (trim($output) != '') {
        run('{{bin/php}} {{deploy_path}}/current/artisan key:generate');
        writeln('<info>' . $output . '</info>');
    }
})->desc('Create env file if missing');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('fix:dotenv', function () {
    $lines = run('cat {{deploy_path}}/current/.env | wc -l');
    if ((int) trim($lines) < 5) {
        upload('.env', '{{deploy_path}}/shared/.env');
        run('sed -i "s/APP_ENV=.*/APP_ENV=' . get('stage', 'stage') . '/gm" {{deploy_path}}/shared/.env');
        run('sed -i "s/APP_DEBUG=.*/APP_DEBUG=false/gm" {{deploy_path}}/shared/.env');
        run('sed -i "s/DB_HOST=.*/DB_HOST=localhost/gm" {{deploy_path}}/shared/.env');
        // run('php {{deploy_path}}/current/artisan key:generate');
        write(' -> review .env shortly! ');
    }
});

/**
 * Services managment
 */
task('reload:php-fpm', function () {
    run('sudo /usr/sbin/service php7.3-fpm reload');
})->desc('Reload PHP7 FPM configuration');

task('reload:nginx', function () {
    run('sudo /usr/sbin/service nginx reload');
})->desc('Reload Nginx configuration');

task('reload:queue', function () {
    run('{{bin/php}} {{deploy_path}}/current/artisan queue:restart');
})->desc('Reload queue handler');

task('reload:supevisor', function () {
    run('sudo /usr/sbin/service supervisor restart');
})->desc('Reload supervisor release version');


/*
|--------------------------------------------------------------------------
| Hooks
|--------------------------------------------------------------------------
 */

after('cleanup', 'env:create');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
// before('deploy:symlink', 'artisan:migrate');
after('deploy:symlink', 'fix:dotenv');

after('cleanup', 'reload:php-fpm');

before('deploy', 'slack:notify');
after('success', 'slack:notify:success');
after('deploy:failed', 'slack:notify:failure');
