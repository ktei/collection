<?php

use Way\Tests\Factory;

class PagesControllerTest extends TestCase {

    public function test_home_should_succeed() {
        $this->action('GET', 'PagesController@home');

        $this->assertResponseOk();
    }

    public function test_home_should_redirect_to_albums_index_after_login() {
        $user = Factory::user();
        $this->be($user);

        $this->action('GET', 'PagesController@home');

        $this->assertRedirectedToAction('AlbumsController@index');
    }

}