<?php

class PagesController extends BaseController {

    public function home() {
        if (Auth::check()) {
            return Redirect::action('AlbumsController@dashboard');
        }
        return View::make('pages.home');
    }

    public function e401() {
        return View::make('pages.errors.401');
    }

    public function e404() {
        return View::make('pages.errors.404');
    }
}