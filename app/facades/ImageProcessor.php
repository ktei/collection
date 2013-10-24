<?php namespace Rui\Collection\Facades;

use Illuminate\Support\Facades\Facade;

class ImageProcessor extends Facade {

    protected static function getFacadeAccessor() {
        return 'imageProcessor';
    }
}