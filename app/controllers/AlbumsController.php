<?php

use Rui\Collection\Repositories\AlbumsRepositoryInterface as AlbumsRepository;
use Rui\Collection\Repositories\PhotosRepositoryInterface as PhotosRepository;
use Rui\Collection\Validation\AlbumValidatorInterface as AlbumValidator;

class AlbumsController extends BaseController {

    public function __construct(
        AlbumsRepository $albumsRepository,
        PhotosRepository $photosRepository,
        AlbumValidator $albumValidator) {

        $this->beforeFilter('auth');
        $this->albumsRepository = $albumsRepository;
        $this->photosRepository = $photosRepository;
        $this->albumValidator = $albumValidator;
    }

    public function index() {
        $params = Input::all();
        $albums = $this->albumsRepository->all($params);
        return View::make('albums.index', compact('albums'));
    }

    public function dashboard() {
        $params = array('user_id' => Auth::user()->id);
        $albums = $this->albumsRepository->all($params);
        return View::make('albums.dashboard', compact('albums'));
    }

    public function browse($id) {
        $album = $this->albumsRepository->findOrFail($id);
        $photos = $this->photosRepository->findByAlbum($id);
        return View::make('albums.manage.browse', compact('album', 'photos'));
    }

    public function create() {
        return View::make('albums.create');
    }

    public function store() {
        $input = array_only(Input::all(), array('name', 'description'));
        $validation = $this->albumValidator->validateStore($input);
        if ($validation === true) {
            $this->albumsRepository->create(array_merge($input, array('user_id' => Auth::user()->id)));
            $this->flashSuccess('Your album has been created successfully.');
            return Redirect::action('AlbumsController@dashboard');
        }
        return Redirect::action('AlbumsController@create')->withErrors($validation);
    }

}