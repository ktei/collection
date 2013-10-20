<?php

namespace Rui\Collection\Repositories;


interface AlbumsRepositoryInterface {

    public function all($params = array());

    public function save($input);
}