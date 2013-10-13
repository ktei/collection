<?php

class Album extends Eloquent {

    protected $table = 'albums';

    protected $fillable = [
        'name',
        'description',
    ];

    public function user() {
        return $this->belongsTo('User');
    }
}