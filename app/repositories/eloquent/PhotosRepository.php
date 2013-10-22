<?php


namespace Rui\Collection\Repositories\Eloquent;


use Rui\Collection\Repositories\PhotosRepositoryInterface;
use Illuminate\Support\Facades\Config;
use \Photo;

class PhotosRepository implements PhotosRepositoryInterface {

    public function findByAlbum($albumId, array $params = array()) {
        $results = array();
        $limit = array_try_get('limit', $params, Config::get('settings.page_limit'));
        $query = Photo::ofAlbum($albumId)->orderBy('created_at', 'desc')->paginate($limit);
        foreach ($query as $row) {
            $results[] = $row;
        }
        return $results;
    }

    public function create(array $params) {

    }

}