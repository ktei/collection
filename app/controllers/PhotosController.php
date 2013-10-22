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

    public function create($id) {
        $album = $this->albumsRepository->findOrFail($id);
        $userId = Auth::user()->id;
        if ($userId != $album->user_id) {
            throwException(new Exception("Not authorized request to album {$album->id}", ERR_UNAUTHORIZED));
        }
        return View::make('albums.manage.upload', compact('album'));
    }
}