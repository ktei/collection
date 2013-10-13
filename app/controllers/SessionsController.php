<?php

class SessionsController extends BaseController {

    public function create() {
        return View::make('sessions.create');
    }

    public function store() {
        $input = Input::all();
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            return Redirect::intended('gallery');
        }
        $this->flashError('Email/password combination is wrong.');
        return Redirect::action('SessionsController@create')
            ->withInput(Input::except('password'));
    }

    public function destroy() {
        Auth::logout();
        $this->flashNotice('You have logged out.');
        return Redirect::action('SessionsController@create');
    }
}