<?php namespace Rui\Collection\Library\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gregwar\Image\Image;

class LocalImageProcessor {

    public function savePhoto(UploadedFile $file, $id) {
        $photo_dir = app_path("../public/upload/photos/{$id}");
        $this->checkDir($photo_dir);
        $lg = PHOTO_LG;
        $md = PHOTO_MD;
        $sm = PHOTO_SM;
        $ext = $file->getClientOriginalExtension();
        Image::open($file->getRealPath())
            ->cropResize(PHOTO_LG_W, PHOTO_LG_H)
            ->save("{$photo_dir}/{$lg}.{$ext}");
        Image::open($file->getRealPath())
            ->zoomCrop(PHOTO_MD_W, PHOTO_MD_H)
            ->save("{$photo_dir}/{$md}.{$ext}");
        Image::open($file->getRealPath())
            ->zoomCrop(PHOTO_SM_W, PHOTO_SM_H)
            ->save("{$photo_dir}/{$sm}.{$ext}");
    }

    private function checkDir($dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
    }
}