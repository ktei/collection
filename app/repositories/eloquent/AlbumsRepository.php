<?php

namespace Rui\Collection\Repositories\Eloquent;


use Rui\Collection\Repositories\AlbumsRepositoryInterface;

class AlbumsRepository implements AlbumsRepositoryInterface{

    public function all($params) {
        $results = array();
        $query = \Album::orderBy('updated_at', 'desc')->paginate(20);
        foreach ($query as $row) {
            $results[] = $row;
        }
        return $results;
    }

    public function save($input) {

    }
}