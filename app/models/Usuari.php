<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class Usuari implements ModelWithImageFieldsInterface, UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;
    use ModelWithImageOrFileFieldsTrait;

    protected $table = "usuaris";
    protected $fillable = ['nom', 'cognom', 'dni', 'email', 'contrasenya', 'nick'];
    
    protected $hidden = array('contrasenya', 'remember_token');
    
    public function scopeDefaultSort($query) {
        return $query->orderBy('nom', 'asc');
    }

    public function getFullNameAttribute() {
        return implode(' ', [$this->nom, $this->cognom]);
    }

    public static function getList() {
        return static::lists('Nom', 'usuaris_id');
    }


    public function getAuthIdentifier() {
        return $this->usuaris_id;
    }

    public function getAuthPassword() {
        return $this->contrasenya;
        
    }
}
