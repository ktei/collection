<?php

namespace Rui\Collection\Repositories;


interface PhotosRepositoryInterface {

    public function findByAlbum($albumId, array $params = array());

    public function create(array $params);
}