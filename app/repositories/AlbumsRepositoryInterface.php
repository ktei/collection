<?php

namespace Rui\Collection\Repositories;


interface AlbumsRepositoryInterface {

    public function all(array $params = array());

    public function create(array $input);

    public function update(array $input);

    public function findOrFail($id);
}