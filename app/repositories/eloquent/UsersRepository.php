<?php

namespace Rui\Collection\Repositories\Eloquent;

use Rui\Collection\Repositories\UsersRepositoryInterface;

class UsersRepository implements UsersRepositoryInterface {

    public function save($input) {
        $model = \User::create($input);
        return $model->id;
    }
}