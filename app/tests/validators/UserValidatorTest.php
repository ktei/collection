<?php

use Way\Tests\Factory;

class UserValidatorTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->prepareDatabase();
        $this->faker = \Faker\Factory::create();
        $this->storeInput = [
            'email' => $this->faker->email,
            'full_name' => $this->faker->firstName . ' ' . $this->faker->lastName,
            'password' => 'Qwerty123?'
        ];
        $this->validator = App::make('Rui\Collection\Validation\UserValidatorInterface');
    }

    public function test_validate_store_with_valid_data_should_succeed() {
        $validation = $this->validator->validateStore($this->storeInput);

        assertThat(true, equalTo($validation));
    }

    public function test_validate_store_with_full_name_too_long_should_fail() {
        $input = array_merge($this->storeInput, ['full_name' => $this->randomString(101)]);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('full_name'));
    }

    public function test_validate_store_with_password_too_short_should_fail() {
        $input = array_merge($this->storeInput, ['password' => $this->randomString(3)]);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('password'));
    }

    public function test_validate_store_with_empty_email_should_fail() {
        $input = array_merge($this->storeInput, ['email' => '']);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('email'));
    }

    public function test_validate_store_with_empty_full_name_should_fail() {
        $input = array_merge($this->storeInput, ['full_name' => '']);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('full_name'));
    }

    public function test_validate_store_with_empty_password_should_fail() {
        $input = array_merge($this->storeInput, ['password' => '']);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('password'));
    }

    public function test_validate_store_with_duplicate_email_should_fail() {
        Factory::create('User', array_merge($this->storeInput));
        $input = array_merge($this->storeInput, ['full_name' => 'another name']);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('email'));
    }

    public function test_validate_store_with_invalid_email_should_fail() {
        $input = array_merge($this->storeInput, ['email' => '@not_an_email']);

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('email'));
    }
}