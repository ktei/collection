<?php

namespace Rui\Collection\Repositories\Eloquent;


use Rui\Collection\Repositories\AlbumsRepositoryInterface;
use Illuminate\Support\Facades\Config;
use \Album;

class AlbumsRepository implements AlbumsRepositoryInterface {

    public function all($params = array()) {
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

    public function save($input) {
        $album = new Album($input);
        $album->user_id = $input['user_id'];
        $album->save();
    }
}