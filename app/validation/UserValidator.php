<?php namespace Rui\Collection\Validation;

use Illuminate\Support\Facades\Validator as Validator;

class UserValidator implements UserValidatorInterface {

    public function validateStore($input) {
        $rules = [
            'full_name' => array('required', 'max:100', 'regex:/^[A-Za-z\s]+$/'),
            'email' => array('required', 'email', 'unique:users'),
            'password' => array('required', 'min:8')
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->passes()) {
            return true;
        }
        return $validator->messages()->toArray();
    }

}