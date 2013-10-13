<?php
use Way\Tests\Factory;

class AlbumsControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->storeInput = [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph()
        ];
    }

    public function test_index_should_reject_without_login() {
        $this->action('GET', 'AlbumsController@index');

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_index_should_have_albums() {
        $user = Factory::user();
        $this->be($user);
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('all')->once()->andReturn(array());
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $response = $this->action('GET', 'AlbumsController@index');

        $this->assertResponseOk();
        $this->assertViewHas('albums');
        $albums = $response->original->getData()['albums'];
        assertThat($albums, is(arrayValue()));
    }

    public function test_create_should_reject_without_login() {
        $this->action('GET', 'AlbumsController@create');

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_store_should_reject_without_login() {
        $input = $this->storeInput;

        $this->action('POST', 'AlbumsController@store', [], $input);

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_store_should_succeed() {
        $user = Factory::user();
        $this->be($user);
        $input = $this->storeInput;
        $mock = Mockery::mock('Rui\Collection\Validation\AlbumValidatorInterface');
        $mock->shouldReceive('validateStore')->once()->andReturn(true);
        $this->app->instance('Rui\Collection\Validation\AlbumValidatorInterface', $mock);
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('save')->once()->andReturn(integerValue());
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('POST', 'AlbumsController@store', [], $input);

        $this->assertRedirectedToAction('AlbumsController@index');
    }

}