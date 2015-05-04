<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Usuari extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    protected $table = "usuaris";
    protected $fillable = ['nom', 'cognom', 'email', 'contrasenya', 'nick','remember_token'];
    
    protected $hidden = array('contrasenya', 'remember_token');
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('cognom', 'asc');
    }

    public function getFullNameAttribute() {
        return implode(' ', [$this->nom, $this->cognom]);
    }

    public static function getList() {
        return static::lists('nom', 'id');
    }

    public function getAuthIdentifier() {
        return $this->id;
    }

    public function getAuthPassword() {
        return $this->contrasenya;
        
    }
}
