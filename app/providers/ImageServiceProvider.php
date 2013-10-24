<?php
namespace Rui\Collection\Providers;

use Illuminate\Support\ServiceProvider;
use Rui\Collection\Library\Image\LocalImageProcessor;

class ImageServiceProvider extends ServiceProvider {

    public function register() {
        $this->app['imageProcessor'] = $this->app->share(function($app) {
            return new LocalImageProcessor();
        });
    }
}