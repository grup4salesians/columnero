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
<!-- TEXT EDITOR STYLES -->
<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/css/summernote.css" rel="stylesheet" type="text/css"/>

<!-- REQUIRED SCRIPTS FILES -->
<!-- TEXT EDITOR SCRIPT -->
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/text-editor/assets/js/summernote.js" type="text/javascript"></script>
<!-- REQUIRED SCRIPT FOR TEXT EDITOR -->

<link href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/highlight/styles/monokai_sublime.css" rel="stylesheet" type="text/css"/>
<script src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/highlight/highlight.pack.js" type="text/javascript"></script>
<script>hljs.initHighlightingOnLoad();</script>

<script>
    $(document).ready(function () {
        $("#TextoNota").summernote({
            height: 250,// set height for editor
        });
        
        $(".note-insert.btn-group").after('<div class="note-highlight btn-group"><button type="button" class="btn btn-default btn-sm btn-small" title="" data-event="highlight" data-hide="true" tabindex="-1" data-original-title="Highlighter"><i class="fa fa-code"></i></button></div>');
        $("button[data-event='codeview']").children().removeClass("fa-code").addClass("fa-html5");
        
        $("button[data-event='highlight']").on("mouseenter", function() {
            console.log("hola");
            var pos = $(this).offset();
            $("#tooltipAPM").css(pos);
            $("#tooltipAPM").css("display", "block");
        });
        
        
        $("button[data-event='highlight']").on("mouseleave").css("display", "none");
        //$(".note-editable").text('<pre><code class="html">...</code></pre>');
    });
</script>
<!-- --------------------- -->
<div class="tooltip fade bottom in" role="tooltip" id="tooltipAPM" style="top: 394px; left: 753.484375px; display: none;"><div class="tooltip-arrow"></div><div class="tooltip-inner">Full Screen</div></div>
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
    .note-editable {
        background-color: #FFF;
    }
</style>
<div id="contingut_home" class="contingut_home">
    <div class="contingut">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line pads">Nova Nota</h4>
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
       
        <div class="pads">
        {{ Form::submit('Crear nova nota',array('class'=> 'btn btn-info','id'=>'BtnSubmitNovaNota','style'=>'margin-top: 15px'))}}
        </div>
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

