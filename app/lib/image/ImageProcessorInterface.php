<?php namespace Rui\Collection\Library\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageProcessorInterface {

    public function savePhoto(UploadedFile $file, $id);
}