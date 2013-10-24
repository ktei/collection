<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Rui\Collection\Library\Image\LocalImageProcessor;

class LocalImageProcessorTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->processor = new LocalImageProcessor();
    }

    public function test_save_photo() {
        $path = app_path('tests/fixtures/uploaded_file.jpg');
        $file = new UploadedFile($path, 'uploaded_file.jpg');
        $this->processor->savePhoto($file, 1);
    }
}