<?php

class AlbumValidatorTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->storeInput = array(
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph()
        );
        $this->validator = App::make('Rui\Collection\Validation\AlbumValidatorInterface');
    }

    public function test_validate_store_with_valid_data_should_succeed() {
        $actual = $this->validator->validateStore($this->storeInput);

        assertThat($actual, equalTo(true));
    }

    public function test_validate_store_with_empty_name_should_fail() {
        $input = array_merge($this->storeInput, array('name' => ''));

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('name'));
    }

    public function test_validate_store_with_name_too_long_should_fail() {
        $input = array_merge($this->storeInput, array('name' => $this->randomString(151)));

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('name'));
    }

    public function test_validate_store_with_description_too_long_should_fail() {
        $input = array_merge($this->storeInput, array('description' => $this->randomString(501)));

        $actual = $this->validator->validateStore($input);

        assertThat($actual, is(arrayValue()));
        assertThat($actual, hasKey('description'));
    }

}