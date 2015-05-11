<?php


class Valoracions extends Eloquent {

    protected $table = "valoracions";
    protected $fillable = ['post_id','usuari_id','favorit'];
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('id', 'desc');
    }

}
