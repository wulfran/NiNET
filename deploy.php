<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'NiNet');

// Project repository
set('repository', 'https://github.com/wulfran/NiNET.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);

//~/domains/{{application}}
// Hosts

host('51.38.130.55')
    ->user('ninet')
    ->set('deploy_path', '/var/www/')
    ->set('composer_options', 'install --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction')
    ->set('writable_mode', 'chmod')
    ->set('bin/composer', function () {
        return 'composer';
    });

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate');

task('test', function (){
    $result = run('pwd');
    writeln('Test ' . $result);
});
