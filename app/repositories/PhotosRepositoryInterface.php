<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rui
 * Date: 10/20/13
 * Time: 11:49 PM
 * To change this template use File | Settings | File Templates.
 */

namespace Rui\Collection\Repositories;


interface PhotosRepositoryInterface {

    public function findByAlbum($albumId, array $params = array());
}