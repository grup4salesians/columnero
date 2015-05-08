@extends('layouts.master')
@section('title')
Perfil Usuari
@stop
@section('content')

<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.css"/>
<script>
    angular.module('myApp', ['ngTagsInput'])
        .controller('MyCtrl', function ($scope, $http) {
        $scope.tags = [
            {text: 'just'},
            {text: 'some'},
            {text: 'cool'},
            {text: 'tags'}
        ];
        $scope.loadTags = function (query) {
            return $http.get('getCategories/' + query);
        };
    });
</script>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/tinymce/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea"
    });
</script>

<style>
    .contingut_home {
        width: 100%;
        overflow: hidden;
        height: auto;
        background-color: rgba(244, 228, 228, 0.34);
        margin: 0 auto;
    }
    .contingut {
        width: 80%;
        text-align: center;
        height: auto;
        border: 1px solid #D86F5D;
        background-color: white;
        margin: auto;
        margin-bottom: 10px;
    }
    .pads {
        padding-left: 10%;
        padding-right: 10%;
    }
    .pads > input, .pads > div, .pads > textarea {
        width: 100%;
    }
    .tagsinput {
        height: 64px;
    }
</style>
<div class="contingut_home">
    <div class="contingut">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Nova Nota</h4>
            </div>
        </div>
        @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error}}<br>        
            @endforeach
        </div>
        @endif
        {{ Form::open(array('url' => '/novanota')) }}
        <div class="pads">
            <p>Títol</p>
            <input id="Titol" name="Titol" type="text">
        </div>
        <div class="pads">
            <p>Categories</p>
            <!-- ngTagsInput -->
            <div class="tagsinput" ng-app="myApp" ng-controller="MyCtrl">
                <tags-input id="ListadoTags" Name="ListadoTags" ng-model="tags">
                    <auto-complete  source="loadTags($query)"></auto-complete>
                </tags-input>
                <input type="hidden" id="ListadoTagsOculto" name="ListadoTagsOculto" /> 
            </div>
        </div>
        <div class="pads">
            <p>Contingut</p>
            <!-- TinyMCE -->
            <textarea id="TextoNota" name="TextoNota"></textarea>
        </div>
        {{ Form::submit('Crear nova nota',array('class'=> 'btn btn-info','id'=>'BtnSubmitNovaNota'))}}
        {{ Form::close() }}
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#BtnSubmitNovaNota").click(function () {
            var textoFinal = "";
            $("#ListadoTags").find("span").each(function () {
                textoFinal = textoFinal + "|" + $(this).text();
            })
            textoFinal = textoFinal.substr(1);
            $("#ListadoTagsOculto").val() = textoFinal;
        });
    });
</script>
@stop

