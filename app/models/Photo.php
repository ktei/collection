<?php

class Photo extends Eloquent {

    protected $table = 'photos';

    public function album() {
        return $this->belongsTo('Album');
    }

    public function scopeOfAlbum($query, $albumId) {
        return $query->where('album_id', '=', $albumId);
    }
}