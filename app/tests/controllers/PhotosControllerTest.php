<?php

use Way\Tests\Factory;

class PhotosControllerTest extends TestCase {

    public function test_create_should_reject_without_login() {
        $this->action('GET', 'PhotosController@create', array('id' => 1));

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_create_should_succeed() {
        $this->mockLogin(array('id' => 1));
        $album = Factory::make('Album', array('id' => 1, 'user_id' => 1));
        $mock = Mockery::mock('Rui\Collection\Repositories\AlbumsRepositoryInterface');
        $mock->shouldReceive('findOrFail')->once()->with(1)->andReturn($album);;
        $this->app->instance('Rui\Collection\Repositories\AlbumsRepositoryInterface', $mock);

        $this->action('GET', 'PhotosController@create', array('id' => 1));

        $this->assertResponseOk();
        $this->assertViewHas('album');
    }

    public function test_upload_should_reject_without_login() {
        $this->action('POST', 'PhotosController@upload', array('id' => 1));

        $this->assertRedirectedToAction('SessionsController@create');
    }

    public function test_upload_should_succeed() {
        $this->mockLogin();
        $imageMock = $this->mockUploadFile();
        //$this->input['photos'] = array($imageMock);
        $this->input['photo'] = $imageMock;
        $mock = Mockery::mock('Rui\Collection\Repositories\PhotosRepositoryInterface');
        $mock->shouldReceive('create')->once();
        $this->app->instance('Rui\Collection\Repositories\PhotosRepositoryInterface', $mock);
        Img::shouldReceive('savePhoto')->once();

        $response = $this->action('POST', 'PhotosController@upload', array('id' => 1), array(), $this->input);
        $json = json_decode($response->getContent());
        assertThat($json->status, equalTo('success'));
    }

    private function mockUploadFile(array $data = array()) {
        // No choice, we need to create a fake image stub first
        // otherwise UploadFile will eventually throw FileNotFound exceptoin
        $filename = app_path('tests/fixtures/foo');
        file_put_contents($filename, '');

        $mock = Mockery::mock('Symfony\Component\HttpFoundation\File\UploadedFile');
        $mock->shouldReceive('isValid')->andReturn(array_try_get('isValid', $data, true));
        $mock->shouldReceive('getSize')->andReturn(array_try_get('getSize', $data, 100));
        $mock->shouldReceive('getPathname')->andReturn($filename);
        $mock->shouldReceive('getClientMimeType')->andReturn(array_try_get('getClientMimeType', $data, 'application/octet-stream'));
        $mock->shouldReceive('getClientSize')->andReturn(array_try_get('getClientSize', $data, 100));
        $mock->shouldReceive('getError')->andReturn(array_try_get('getError', $data, null));
        $mock->shouldReceive('getClientOriginalName')->andReturn(array_try_get('getClientOriginalName', $data, 'foo.jpg'));
        return $mock;
    }

}