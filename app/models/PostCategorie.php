<?php


class PostCategorie extends Eloquent {

    protected $table = "postscategories";
    protected $fillable = ['categoria_id', 'post_id'];
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('id', 'asc');
    }
    
    public static function getList() {
        return static::lists('id');
    }
    
    public function Post(){
       return $this->belongsTo('Post','post_id');
    }
}
