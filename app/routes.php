<?php

Route::get('/login', 'SessionsController@create');
Route::get('/signup', 'UsersController@create');

Route::get('/', 'PagesController@home');
