<?php

namespace Rui\Collection\Repositories\Eloquent;

use Rui\Collection\Repositories\UsersRepositoryInterface;
use \User;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface {

    protected $model = 'User';

    public function create(array $params) {
        $model = $this->createModel('User', $params);
        return $model;
    }

    public function update(array $params) {
        $this->updateModel('User', $params);
    }
}