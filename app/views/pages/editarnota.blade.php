@extends('layouts.master')
@section('title')
Editar nota
@stop
@section('content')

<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/angular/angular.min.js"></script>
<script type="text/javascript" src="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.BaseUrl'); ?>public/assets/vendor/ng-tags-input/ng-tags-input.min.css"/>
<?php $querypost = Post::where('id','=',$id)->get(); ?>
<?php  $querycat = DB::table('categories')
                    ->join('categoriesusuaris', 'categories.id', '=', 'categoriesusuaris.categories_id')
                    ->where('categoriesusuaris.usuaris_id', Auth::user()->id)
                    ->select('categories.nom')
                    ->get(); ?>
<script>
    angular.module('myApp', ['ngTagsInput'])
        .controller('MyCtrl', function ($scope, $http) {
        $scope.tags = [
  {text: '<?php echo $querycat[0]->nom ?>'},
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
<div id="contingut_home" class="contingut_home">
    <div class="contingut">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Editar nota</h4>
            </div>
        </div>
        @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error}}<br>        
            @endforeach
        </div>
        @endif
       <?php echo Form::open(array('url' => '/editarnota/'.$id.'')) ?>
        <div class="pads">
            <p>Títol</p>
            <input id="Titol" name="Titol" type="text" value="<?php echo $querypost[0]->titol ?>">
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
            <textarea id="TextoNota" name="TextoNota"><?php echo $querypost[0]->comentari ?></textarea>
        </div>
        <br>
        {{ Form::submit('Guardar',array('class'=> 'btn btn-info','id'=>'BtnSubmitEditarNota'))}}
        {{ Form::close() }}
        <br>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#BtnSubmitEditarNota").click(function () {
            var textoFinal = "";
            $("#ListadoTags").find("span").each(function () {
                textoFinal = textoFinal + "|" + $(this).text();
            });
            textoFinal = textoFinal.substr(1);
            $("#ListadoTagsOculto").val(textoFinal);
        });
    });
</script>
@stop

