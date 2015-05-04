<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Illuminate\Database\Eloquent;

class Post extends Eloquent implements UserInterface, RemindableInterface {
    protected $table = 'posts';
    
    protected $fillable = [
        "titol",
        "comentari",
        "usuari_id",
        "data",
        "privat"
    ];
    
    protected $hidden = [
        "created_at",
        "updated_at"
    ];
}

