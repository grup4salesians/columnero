<?php


class CategoriesUsuari extends Eloquent {

    protected $table = "categoriesusuaris";
    protected $fillable = ['categories_id', 'usuaris_id','mostrar'];
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('id', 'asc');
    }
    
    public static function getList() {
        return static::lists('id');
    }
    
    public function Categorie(){
       return $this->belongsTo('Categorie','categories_id');
    }
}
