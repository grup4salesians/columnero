<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="">{{ $titolNota }}</a>
             <a style="float:right;margin-right:10px;font-size:20px;cursor:pointer;" data-toggle="modal" data-target="#{{$idModal}}" title="eliminar" class="fa fa-trash"></a>
            <a style="float:right;margin-right:10px;font-size:20px;" title="editar" class="fa fa-pencil-square-o" href="<?php Config::get('constants.BaseUrl');?>editarnota/{{$idnota}}"></a>
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
        <div class="panel-body">
            {{ $comentariNota }}
        </div>
    </div>
    <div class="panel-footer">
        {{$categories}}
    </div>
</div>

<!-- Small modal -->


<div id="{{$idModal}}" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div id="eliminarnota">
            <label>Estás segur que vols eliminar aquesta nota? </label>
      <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      <a href="<?php Config::get('constants.BaseUrl');?>eliminarnota/{{$idnota}}"><button type="button" class="btn btn-danger">Si</button></a>
      </div>
    </div>
  </div>
</div>