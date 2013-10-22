<?php

namespace Rui\Collection\Providers;

use \App;
use \Exception;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Redirect;

class AppErrorsHandlingProvider extends ServiceProvider {

    public function register() {
    }


    /*
    |--------------------------------------------------------------------------
    | Application Error Handler
    |--------------------------------------------------------------------------
    |
    | Here you may handle any errors that occur in your application, including
    | logging them or displaying custom views for specific errors. You may
    | even register several error handlers to handle different types of
    | exceptions. If nothing is returned, the default error view is
    | shown, which includes a detailed stack trace during debug.
    |
    */
    public function boot() {

        App::error(function(Exception $exception, $code)
        {
            Log::error($exception);
            if ($code == ERR_NOT_FOUND) {
                return $this->handle404($exception);
            }
        });


        App::error(function(ModelNotFoundException $e)
        {
            return $this->handle404($e);
        });
    }

    private function handle404(Exception $e) {
        return Redirect::action('PagesController@e404');
    }

}