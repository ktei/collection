<?php namespace Rui\Collection\Observers;

use Illuminate\Support\ServiceProvider;

use Rui\Collection\Models\User as User;

class ObserverServiceProvider extends ServiceProvider {

    public function register() {

    }

    public function boot() {
        User::observe(new UserObserver);
    }
}