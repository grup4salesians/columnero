@extends('layouts.master')
@section('title')
Perfil Usuari
@stop
@section('content')
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
        <div class="pads">
            <p>Títol</p>
            <input id="" type="text">
        </div>
        <div class="pads">
            <p>Categories</p>
            <!-- ngTagsInput -->
            <div class="tagsinput" ng-app="myApp" ng-controller="MyCtrl">
                <tags-input ng-model="tags">
                    <auto-complete source="loadTags($query)"></auto-complete>
                </tags-input>
            </div>
            
        </div>
        <div class="pads">
            <p>Contingut</p>
            <!-- TinyMCE -->
            <form method="post">
                <textarea></textarea>
            </form>
        </div>
    </div>
</div>
@stop
