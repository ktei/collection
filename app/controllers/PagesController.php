<?php

class PagesController extends BaseController {

    public function home() {
        if (Auth::check()) {
            return Redirect::action('AlbumsController@dashboard');
        }
        return View::make('pages.home');
    }
}