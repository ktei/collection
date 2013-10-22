<?php

use Way\Tests\Factory;
use \Illuminate\Database\Eloquent\ModelNotFoundException;


class AlbumsControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->storeInput = array(
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph()
        );
    }

    public function test_index_should_reject_without_login() {
        $this->action('GET', 'AlbumsController@index');

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_index_should_have_albums() {
        $this->mockLogin();
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('all')->once()->andReturn(array());
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('GET', 'AlbumsController@index');

        $this->assertResponseOk();
        $this->assertViewHas('albums');
    }

    public function test_index_should_paginate_albums() {
        $this->mockLogin();
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('all')->once()->with(array('page' => 2, 'limit' => 10))->andReturn(array());;
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('GET', 'AlbumsController@index', array(), array('page' => 2, 'limit' => 10));

        $this->assertResponseOk();
        $this->assertViewHas('albums');
    }

    public function test_dashboard_should_have_albums() {
        $user = $this->mockLogin();
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('all')->once()->with(array('user_id' => $user->id))->andReturn(array());;
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('GET', 'AlbumsController@dashboard');

        $this->assertResponseOk();
        $this->assertViewHas('albums');
    }

    public function test_create_should_reject_without_login() {
        $this->action('GET', 'AlbumsController@create');

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_store_should_reject_without_login() {
        $input = $this->storeInput;

        $this->action('POST', 'AlbumsController@store', array(), $input);

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_store_should_succeed() {
        $user = $this->mockLogin();
        $input = $this->storeInput;
        $mock = Mockery::mock('Rui\Collection\Validation\AlbumValidatorInterface');
        $mock->shouldReceive('validateStore')->once()->with($input)->andReturn(true);
        $this->app->instance('Rui\Collection\Validation\AlbumValidatorInterface', $mock);
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('create')->with(array_merge($input, array('user_id' => $user->id)))->once();
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('POST', 'AlbumsController@store', array(), $input);

        $this->assertRedirectedToAction('AlbumsController@dashboard');
    }

    public function test_browse_should_display_photos() {
        $this->mockLogin();
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('findOrFail')->once()->with(1)->andReturn(Factory::make('Album', array('id' => 1)));
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);
        $mock = Mockery::mock('Rui\Collection\Repositories\PhotosRepositoryInterface');
        $mock->shouldReceive('findByAlbum')->once()->with(1)->andReturn(array());
        $this->app->instance('Rui\Collection\Repositories\PhotosRepositoryInterface', $mock);

        $this->action('GET', 'AlbumsController@browse', array('id' => 1));

        $this->assertResponseOk();
        $this->assertViewHas('album');
        $this->assertViewHas('photos');
    }

}