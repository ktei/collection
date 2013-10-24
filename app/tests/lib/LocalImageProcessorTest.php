<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Rui\Collection\Library\Image\LocalImageProcessor;

class LocalImageProcessorTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->processor = new LocalImageProcessor();
    }

    public function test_save_photo() {
        // Clean up old files
        delete_dir(app_path('../public/upload/photos/0'));
        $path = app_path('tests/fixtures/uploaded_file.jpg');
        $file = new UploadedFile($path, 'uploaded_file.jpg');

        $this->processor->savePhoto($file, 0); // Use 0 to avoid polluting existing files

        assertThat(file_exists(app_path('../public/upload/photos/0/lg.jpg')), equalTo(true));
        assertThat(file_exists(app_path('../public/upload/photos/0/md.jpg')), equalTo(true));
        assertThat(file_exists(app_path('../public/upload/photos/0/sm.jpg')), equalTo(true));
    }
}