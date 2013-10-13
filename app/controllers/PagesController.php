<?php

class PagesController extends BaseController {

    public function home() {
        if (Auth::check()) {
            return Redirect::action('AlbumsController@index');
        }
        return View::make('pages.home');
    }
}