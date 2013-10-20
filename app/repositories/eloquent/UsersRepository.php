<?php

namespace Rui\Collection\Repositories\Eloquent;

use Rui\Collection\Repositories\UsersRepositoryInterface;
use \User;

class UsersRepository implements UsersRepositoryInterface {

    public function save($input) {
        User::create($input);
    }
}