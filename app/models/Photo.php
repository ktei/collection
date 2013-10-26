<?php

class Photo extends Eloquent {

    protected $table = 'photos';

    public function album() {
        return $this->belongsTo('Album');
    }

    public function scopeOfAlbum($query, $albumId) {
        return $query->where('album_id', '=', $albumId);
    }

    public function getSmUrlAttribute() {
        return $this->buildUrl(PHOTO_SM);
    }

    public function getMdUrlAttribute() {
        return $this->buildUrl(PHOTO_MD);
    }

    public function getLgUrlAttribute() {
        return $this->buildUrl(PHOTO_LG);
    }

    private function buildUrl($filename) {
        if (Config::get('settings.image_store') == 'local') {
            return URL::asset("upload/photos/{$this->id}/{$filename}.jpg");
        }
    }
}