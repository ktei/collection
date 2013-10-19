<?php

namespace Rui\Collection\Validation;

use Illuminate\Support\Facades\Validator as Validator;

class AlbumValidator implements AlbumValidatorInterface {

    public function validateStore($input) {
        $rules = array(
            'name' => array('required', 'max:150'),
            'description' => array('max:500'),
        );
        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {
            return true;
        }
        return $validator->messages()->toArray();
    }
}