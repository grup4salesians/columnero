<?php


class Post extends Eloquent {

    protected $table = "posts";
    protected $fillable = ['titol', 'comentari', 'usuari_id', 'data', 'privat'];
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('data', 'desc');
    }

    public static function getList() {
        return static::lists('titol', 'id');
    }
}
