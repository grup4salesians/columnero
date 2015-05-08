@extends('layouts.master')
@section('title')
Nova nota
@stop
@section('content')

<!-- ngTagsInput -->
<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.css"/>
<script>
    angular.module('myApp', ['ngTagsInput'])
        .controller('MyCtrl', function ($scope, $http) {
//        $scope.tags = [
//            {text: 'just'},
//            {text: 'some'},
//            {text: 'cool'},
//            {text: 'tags'}
//        ];
        $scope.loadTags = function (query) {
            return $http.get('getCategories/' + query);
        };
    });
</script>
<!-- ----------- -->

<!-- Bootstrap Text Editor -->
<!-- BOOTSTRAP STYLE SHEET -->
<!--<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/css/bootstrap.css" rel="stylesheet" type="text/css"/>-->
 <!-- REQUIRED ICONS FOR TEXT EDITOR -->
<!--<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>-->
<!-- TEXT EDITOR STYLES -->
<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/css/summernote.css" rel="stylesheet" type="text/css"/>

<!-- REQUIRED SCRIPTS FILES -->
<!-- CORE JQUERY FILE -->
<!--<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/js/jquery-1.11.1.js" type="text/javascript"></script>-->
<!-- REQUIRED BOOTSTRAP SCRIPTS -->
<script src="<?php // echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/js/bootstrap.js" type="text/javascript"></script>
  <!-- TEXT EDITOR SCRIPT -->
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/js/summernote.js" type="text/javascript"></script>
 <!-- REQUIRED SCRIPT FOR TEXT EDITOR -->
<script>
    $(document).ready(function () {
        $('#TextoNota').summernote({
            height: 250,// set height for editor
        });
    });
</script>
<!-- --------------------- -->

<style>
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
    .note-editor button {
        height: 30px;
    }
</style>
<div id="contingut_home" class="contingut_home">
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
        <br>
        {{ Form::submit('Crear nova nota',array('class'=> 'btn btn-info','id'=>'BtnSubmitNovaNota'))}}
        {{ Form::close() }}
        <br>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#BtnSubmitNovaNota").click(function () {
            var textoFinal = "";
            $("#ListadoTags").find("span").each(function () {
                if ($(this).text() !== "Add a tag") {
                    textoFinal = textoFinal + $(this).text() +"|";
                }
            });
            $("#ListadoTagsOculto").val(textoFinal);
        });
    });
</script>
@stop

