<?php

use Way\Tests\Factory;

class UsersRepositoryTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->prepareDatabase();
        $this->usersRepository = App::make('Rui\Collection\Repositories\UsersRepositoryInterface');
    }

    public function test_create_user() {
        $attrs = array('email' => 'foo@bar.com', 'password' => 'Qwerty123?', 'full_name' => 'foo bar');

        $this->usersRepository->create($attrs);

        assertThat(User::count(), equalTo(1));
        assertThat(User::first()->full_name, equalTo('foo bar'));
    }

    public function test_update_user() {
        $user = Factory::create('User');
        $attrs = array('id' => $user->id, 'email' => 'foo@bar.com', 'full_name' => 'foo bar');

        $this->usersRepository->update($attrs);

        $actual = User::findOrFail($user->id);
        assertThat($actual->email, equalTo('foo@bar.com'));
        assertThat($actual->full_name, equalTo('foo bar'));
    }
}