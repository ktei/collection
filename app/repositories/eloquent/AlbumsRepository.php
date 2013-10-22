<?php

namespace Rui\Collection\Repositories\Eloquent;


use Rui\Collection\Repositories\AlbumsRepositoryInterface;
use Illuminate\Support\Facades\Config;
use \Album;

class AlbumsRepository implements AlbumsRepositoryInterface {

    public function all(array $params = array()) {
        $results = array();
        $limit = array_try_get('limit', $params, Config::get('settings.page_limit'));
        $query = null;
        if (array_key_exists('user_id', $params)) {
            $query = Album::ownedBy($params['user_id'])->orderBy('updated_at', 'desc')->paginate($limit);
        } else {
            $query = Album::orderBy('updated_at', 'desc')->paginate($limit);
        }
        foreach ($query as $row) {
            $results[] = $row;
        }
        return $results;
    }

    public function create(array $params) {
        $album = new Album($params);
        $album->user_id = $params['user_id'];
        $album->save();
    }

    public function update(array $params) {
        $album = Album::findOrFail($params['id']);
        if (array_key_exists('name', $params)) {
            $album->name = $params['name'];
        }
        if (array_key_exists('description', $params)) {
            $album->description = $params['description'];
        }
        $album->save();
    }

    public function findOrFail($id) {
        return Album::findOrFail($id);
    }

}