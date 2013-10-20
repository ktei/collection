<?php

class UserTest extends TestCase {

    public function test_should_hash_password_when_set() {
        Hash::shouldReceive('make')->once()->andReturn('hashed');

        $user = new User;
        $user->password = 'foo';

        assertThat($user->password, 'hashed');
    }

}