@extends('layouts.master')
@section('title')
Perfil Usuari
@stop
@section('content')
<style>
    .inputperfil{
        width:30%;
        font-size:20px;
        text-align:center;

    }
    .labelperfil{
        font-size:20px;
        text-align:left;
    }
</style>
<div id="contingut_home">


    <div id="Bloque_inside_perfil"><br>
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Perfil Usuari -<?php echo $userdata[0]->nick ?>-</h4>
            </div>
        </div>

        <span class="labelperfil">Nom</span>  <br>
        <input type="text" class="inputperfil" value="<?php echo $userdata[0]->nom ?>" disabled="disabled"><br>
        <span class="labelperfil">Cognom</span><br>
        <input type="text" class="inputperfil" value="<?php echo $userdata[0]->cognom; ?>" disabled="disabled"><br>
        <span class="labelperfil">Nick</span> <br>
        <input type="text" class="inputperfil" value="<?php echo $userdata[0]->nick; ?>" disabled="disabled"><br>
        <span class="labelperfil">Email</span> <br>
        <input type="text" class="inputperfil" value="<?php echo $userdata[0]->email; ?>" disabled="disabled"><br>
        <span class="labelperfil">Nº de posts</span> <br>
        <input type="text" class="inputperfil" value=" <?php
               $querypost = Post::where('usuari_id', $userdata[0]->id)->select();
               echo count($querypost->get());
               ?>" disabled="disabled"><br><br>          
    </div>
</div>

@stop
