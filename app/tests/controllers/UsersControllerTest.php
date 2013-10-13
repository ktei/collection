<?php

class UsersControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->signUpInput = [
            'email' => $this->faker->email,
            'full_name' => "{$this->faker->firstName} {$this->faker->lastName}",
            'password' => 'Qwerty123?'
        ];
    }

    public function test_create_should_succeed() {
        $this->action('GET', 'UsersController@create');

        $this->assertResponseOk();
    }

    public function test_store_should_succeed() {
        $input = $this->signUpInput;
        $mock = Mockery::mock('Rui\Collection\Validation\UserValidatorInterface');
        $mock->shouldReceive('validateStore')->once()->andReturn(true);
        $this->app->instance('Rui\Collection\Validation\UserValidatorInterface', $mock);
        $mock = Mockery::mock('Rui\Collection\Repositories\UsersRepositoryInterface');
        $mock->shouldReceive('save')->once()->andReturn(integerValue());
        $this->app->instance('Rui\Collection\Repositories\UsersRepositoryInterface', $mock);
        Auth::shouldReceive('loginUsingId')->once();

        $this->action('POST', 'UsersController@store', [], $input);

        $this->assertRedirectedToAction('AlbumsController@index');
        $this->assertSessionHas('success');
    }

}