<?php

namespace Rui\Collection\Repositories\Eloquent;


use Rui\Collection\Repositories\AlbumsRepositoryInterface;
use Illuminate\Support\Facades\Config;
use \Album;

class AlbumsRepository extends BaseRepository implements AlbumsRepositoryInterface {

    protected $model = 'Album';

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
        $model = $this->createModel('Album', $params);
        return $model->id;
    }

    public function update(array $params) {
        $this->updateModel('Album', $params);
    }

}