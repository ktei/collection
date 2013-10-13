<?php

use \Rui\Collection\Repositories\UsersRepositoryInterface as UsersRepository;
use \Rui\Collection\Validation\UserValidatorInterface as UserValidator;

class UsersController extends BaseController {

    public function __construct(UsersRepository $usersRepository,
                                UserValidator $userValidator) {
        $this->usersRepository = $usersRepository;
        $this->userValidator = $userValidator;
    }

    public function create() {
        return View::make('users.create');
    }

    public function store() {
        $input = Input::all();
        $validation = $this->userValidator->validateStore($input);
        if ($validation === true) {
            $userId = $this->usersRepository->save($input);
            Auth::loginUsingId($userId);
            $this->flashSuccess('Your account has been created successfully. Now enjoy!');
            return Redirect::action('AlbumsController@index');
        }
        return Redirect::action('UsersController@create')
            ->withInput(Input::except('password'))
            ->withErrors($validation);
    }
}