<?php

use Rui\Collection\Repositories\AlbumsRepositoryInterface as AlbumsRepository;
use Rui\Collection\Repositories\PhotosRepositoryInterface as PhotosRepository;

class PhotosController extends BaseController {

    public function __construct(
        PhotosRepository $photosRepository,
        AlbumsRepository $albumsRepository) {

        $this->beforeFilter('auth');
        $this->photosRepository = $photosRepository;
        $this->albumsRepository = $albumsRepository;
    }

    public function create($albumId) {
        $album = $this->albumsRepository->findOrFail($albumId);
        $userId = Auth::user()->id;
        if ($userId != $album->user_id) {
            throwException(new Exception("Not authorized request to album {$album->id}", ERR_UNAUTHORIZED));
        }
        return View::make('albums.manage.upload', compact('album'));
    }

    public function upload($albumId) {
        if (Input::hasFile('photo')) {
            $photoId = $this->photosRepository->create(array('album_id' => $albumId));
            $file = Input::file('photo');
            Img::savePhoto($file, $photoId);
            return $this->jsonSuccess();
        }
        return $this->jsonFail('No photo file is found.');
    }
}