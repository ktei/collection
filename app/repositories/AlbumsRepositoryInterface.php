<?php

namespace Rui\Collection\Repositories;


interface AlbumsRepositoryInterface {

    public function all(array $params = array());

    public function create(array $params);

    public function update(array $params);

    public function findOrFail($id);
}