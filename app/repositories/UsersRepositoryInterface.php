<?php

namespace Rui\Collection\Repositories;


interface UsersRepositoryInterface {

    public function create(array $params);

    public function update(array $params);
}