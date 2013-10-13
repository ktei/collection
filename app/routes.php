<?php

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::any('/logout', 'SessionsController@destroy');

Route::get('/signup', 'UsersController@create');
Route::post('/signup', 'UsersController@store');

Route::get('/gallery', 'AlbumsController@index');
Route::get('/albums/create', 'AlbumsController@create');
Route::post('/albums/create', 'AlbumsController@store');

Route::get('/', 'PagesController@home');

