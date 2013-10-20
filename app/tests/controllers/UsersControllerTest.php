<?php

class UsersControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->signUpInput = array(
            'email' => $this->faker->email,
            'full_name' => "{$this->faker->firstName} {$this->faker->lastName}",
            'password' => 'Qwerty123?'
        );
    }

    public function test_create_should_succeed() {
        $this->action('GET', 'UsersController@create');

        $this->assertResponseOk();
    }

    public function test_store_should_succeed() {
        $input = $this->signUpInput;
        $mock = Mockery::mock('Rui\Collection\Validation\UserValidatorInterface');
        $mock->shouldReceive('validateStore')->once()->with($input)->andReturn(true);
        $this->app->instance('Rui\Collection\Validation\UserValidatorInterface', $mock);
        $mock = Mockery::mock('Rui\Collection\Repositories\UsersRepositoryInterface');
        $mock->shouldReceive('create')->once()->with($input);
        $this->app->instance('Rui\Collection\Repositories\UsersRepositoryInterface', $mock);
        Auth::shouldReceive('getDrivers')->andReturn(arrayValue());
        Auth::shouldReceive('loginUsingId')->once();

        $this->action('POST', 'UsersController@store', array(), $input);

        $this->assertRedirectedToAction('AlbumsController@index');
        $this->assertSessionHas('success');
    }

    public function test_store_should_redirect_to_create_when_validation_fails() {
        $mock = Mockery::mock('Rui\Collection\Validation\UserValidatorInterface');
        $mock->shouldReceive('validateStore')->once()->with(array())->andReturn(
            array('full_name' => 'error', 'email' => 'error', 'password' => 'error'));
        $this->app->instance('Rui\Collection\Validation\UserValidatorInterface', $mock);
        $mock = Mockery::mock('Rui\Collection\Repositories\UsersRepositoryInterface');
        $mock->shouldReceive('create')->never();
        $this->app->instance('Rui\Collection\Repositories\UsersRepositoryInterface', $mock);

        $this->action('POST', 'UsersController@store', array(), array());

        $this->assertRedirectedToAction('UsersController@create');
    }

}