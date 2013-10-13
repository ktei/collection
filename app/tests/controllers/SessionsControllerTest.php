<?php


class SessionsControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->loginInput = [
            'email' => $this->faker->email,
            'password' => 'Qwerty123?'
        ];
    }

    public function test_create_should_succeed() {
        $this->action('GET', 'SessionsController@create');

        $this->assertResponseOk();
    }

    public function test_store_should_succeed() {
        Auth::shouldReceive('attempt')->once()->andReturn(true);

        $this->action('POST', 'SessionsController@store');

        $this->assertRedirectedToAction('AlbumsController@index');
    }
}