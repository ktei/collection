<?php

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::any('/logout', 'SessionsController@destroy');

Route::get('/signup', 'UsersController@create');
Route::post('/signup', 'UsersController@store');

Route::get('/gallery', 'AlbumsController@index');
Route::get('/dashboard', 'AlbumsController@dashboard');
Route::get('/albums/create', 'AlbumsController@create');
Route::post('/albums/create', 'AlbumsController@store');
Route::get('/dashboard/album/{id}', 'AlbumsController@browse')->where('id', '[0-9]+');
Route::get('/dashboard/album/{id}/upload', 'PhotosController@create')->where('id', '[0-9]+');
Route::post('/photos/upload', 'PhotosController@store');

Route::get('/', 'PagesController@home');

Route::get('/e401', 'PagesController@e401');
Route::get('/e404', 'PagesController@e404');

