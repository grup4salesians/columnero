<?php


class Categorie extends Eloquent {

    protected $table = "categories";
    protected $fillable = ['nom'];
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('id', 'desc');
    }

    public static function getList() {
        return static::lists('nom', 'id');
    }
}
