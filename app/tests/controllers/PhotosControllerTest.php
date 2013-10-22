<?php

use Way\Tests\Factory;

class PhotosControllerTest extends TestCase {

    public function test_create_should_reject_without_login() {
        $this->action('GET', 'PhotosController@create', array('id' => 1));

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_create_should_return_success() {
        $user = $this->mockLogin(array('id' => 1));
        $album = Factory::make('Album', array('id' => 1, 'user_id' => 1));
        Auth::shouldReceive('user')->andReturn($user);
        Auth::shouldReceive('guest');
        Auth::shouldReceive('check');
        Auth::shouldReceive('getDrivers')->andReturn(array());
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('findOrFail')->once()->with(1)->andReturn($album);;
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('GET', 'PhotosController@create', array('id' => 1));

        $this->assertResponseOk();
        $this->assertViewHas('album');
    }

    public function test_store_should_reject_without_login() {
        $this->action('POST', 'PhotosController@store', array());

        $this->assertRedirectedToAction('SessionsController@create');
    }

}