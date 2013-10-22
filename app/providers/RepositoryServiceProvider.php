<?php namespace Rui\Collection\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind(
            'Rui\Collection\Repositories\UsersRepositoryInterface',
            'Rui\Collection\Repositories\Eloquent\UsersRepository'
        );

        $this->app->bind(
            'Rui\Collection\Repositories\AlbumsRepositoryInterface',
            'Rui\Collection\Repositories\Eloquent\AlbumsRepository'
        );

        $this->app->bind(
            'Rui\Collection\Repositories\PhotosRepositoryInterface',
            'Rui\Collection\Repositories\Eloquent\PhotosRepository'
        );
    }

}