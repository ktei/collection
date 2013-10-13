<?php namespace Rui\Collection\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(
            'Rui\Collection\Repositories\UsersRepositoryInterface',
            'Rui\Collection\Repositories\Eloquent\UsersRepository'
        );
    }

}