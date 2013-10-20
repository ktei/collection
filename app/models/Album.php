<?php

class Album extends Eloquent {

    protected $table = 'albums';

    protected $fillable = array(
        'name',
        'description',
    );

    public function user() {
        return $this->belongsTo('User');
    }

    public function scopeOwnedBy($query, $userId) {
        return $query->where('user_id', '=', $userId);
    }
}