<?php
namespace Rui\Collection\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Rui\Collection\Library\Image\LocalImageProcessor;

class ImageServiceProvider extends ServiceProvider {

    public function register() {
        $this->app['imageProcessor'] = $this->app->share(function($app) {
            if (Config::get('settings.image_store') == 'local') {
                return new LocalImageProcessor();
            }
        });
    }
}