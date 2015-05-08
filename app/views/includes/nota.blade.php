<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            {{ $titolNota }}
        </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
        <div class="panel-body">
            {{ $comentariNota }}
        </div>
    </div>
    <div class="panel-footer" style="background-color: #F9F9F9;">
        <a href="<?php echo Config::get('constants.BaseUrl'); ?>public/usuari/{{ $nick }}">{{ $nick }}</a>
    </div>
    <div class="panel-footer">
        {{$categories}}
    </div>
</div>