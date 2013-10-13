<?php

use Rui\Collection\Repositories\AlbumsRepositoryInterface as AlbumsRepository;
use Rui\Collection\Validation\AlbumValidatorInterface as AlbumValidator;

class AlbumsController extends BaseController {

    public function __construct(AlbumsRepository $albumsRepository, AlbumValidator $albumValidator) {
        $this->beforeFilter('auth');
        $this->albumsRepository = $albumsRepository;
        $this->albumValidator = $albumValidator;
    }

    public function index() {
        $params = Input::all();
        $albums = $this->albumsRepository->all($params);
        return View::make('albums.index', compact('albums'));
    }

    public function create() {

    }

    public function store() {
        $input = Input::all();
        $validation = $this->albumValidator->validateStore($input);
        if ($validation === true) {
            $albumId = $this->albumsRepository->save($input);
            $this->flashSuccess('Your album has been created successfully.');
            return Redirect::action('AlbumsController@index');
        }
        return Redirect::action('AlbumsController@create')->withErrors($validation);
    }

}