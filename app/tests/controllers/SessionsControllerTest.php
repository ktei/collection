<?php
use Way\Tests\Factory;

class SessionsControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->loginInput = array(
            'email' => $this->faker->email,
            'password' => 'Qwerty123?'
        );
    }

    public function test_create_should_succeed() {
        $this->action('GET', 'SessionsController@create');

        $this->assertResponseOk();
    }

    public function test_store_should_succeed() {
        Auth::shouldReceive('getDrivers')->once()->andReturn(arrayValue());
        Auth::shouldReceive('attempt')->once()->andReturn(true);

        $this->action('POST', 'SessionsController@store', array(), $this->loginInput);

        $this->assertRedirectedToAction('AlbumsController@index');
    }

    public function test_destroy_should_succeed() {
        $user = Factory::user();
        $this->be($user);

        $this->action('GET', 'SessionsController@destroy');

        $this->assertRedirectedToAction('SessionsController@create');
        $this->assertSessionHas('notice');
    }
}