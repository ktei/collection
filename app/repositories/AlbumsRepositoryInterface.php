<?php

namespace Rui\Collection\Repositories;


interface AlbumsRepositoryInterface {

    public function all($params);

    public function save($input);
}