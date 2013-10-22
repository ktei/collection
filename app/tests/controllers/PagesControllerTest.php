<?php


class PagesControllerTest extends TestCase {

    public function test_home_should_succeed() {
        $this->action('GET', 'PagesController@home');

        $this->assertResponseOk();
    }

    public function test_home_should_redirect_to_albums_index_after_login() {
        $this->mockLogin();

        $this->action('GET', 'PagesController@home');

        $this->assertRedirectedToAction('AlbumsController@dashboard');
    }

    public function test_e404_should_succeed() {
        $this->action('GET', 'PagesController@e404');

        $this->assertResponseOk();
    }

    public function test_e401_should_succeed() {
        $this->action('GET', 'PagesController@e401');

        $this->assertResponseOk();
    }

}