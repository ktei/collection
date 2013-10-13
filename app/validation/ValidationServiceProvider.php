<?php

namespace Rui\Collection\Validation;

use Illuminate\Support\ServiceProvider;


class ValidationServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(
            'Rui\Collection\Validation\UserValidatorInterface',
            'Rui\Collection\Validation\UserValidator'
        );

        $this->app->bind(
            'Rui\Collection\Validation\AlbumValidatorInterface',
            'Rui\Collection\Validation\AlbumValidator'
        );
    }
}