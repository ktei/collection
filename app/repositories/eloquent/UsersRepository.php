<?php

namespace Rui\Collection\Repositories\Eloquent;

use Rui\Collection\Repositories\UsersRepositoryInterface;
use \User;

class UsersRepository implements UsersRepositoryInterface {

    public function create(array $params) {
        User::create($params);
    }

    public function update(array $params) {
        $user = User::findOrFail($params['id']);
        if (array_key_exists('email', $params)) {
            $user->email = $params['email'];
        }
        if (array_key_exists('password', $params)) {
            $user->password = $params['password'];
        }
        if (array_key_exists('full_name', $params)) {
            $user->full_name = $params['full_name'];
        }
        $user->save();
    }
}