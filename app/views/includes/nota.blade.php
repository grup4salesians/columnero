<?php
$queryfavoritos = DB::table('valoracions')
        ->where('usuari_id', '=', Auth::user()->id)
        ->where('post_id', '=', $id)
        ->where('favorit', '=', 1)
        ->get();
?>
<div class="panel panel-default" data-date="{{ $data }}">
    <div class="panel-heading" style="position:relative;">
        <h4 class="panel-title">
            {{ $titolNota }}
        </h4>
        <?php if($nick == Auth::user()->nick){ ?>
            <a style="float:right;margin-right:10px;font-size:20px;position:absolute;right: 0;top: 9px;" title="editar" href="<?php Config::get('constants.BaseUrl');?>editarnota/{{$id}}"><i class="fa fa-pencil-square-o" ></i></a>

        <?php }?>

    </div>
    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
        <div class="panel-body">
            {{ $comentariNota }}
        </div>
    </div>
    <div class="panel-footer autor" style="background-color: #F9F9F9;">
        <a href="<?php echo Config::get('constants.BaseUrl'); ?>public/usuari/{{ $nick }}">{{ $nick }}</a>
    </div>
    <div class="panel-footer" style="min-height:49px;">
        <div class="categories" style="float: left;">{{$categories}}</div>
        <?php if (count($queryfavoritos) == 0) { ?>

            {{$categories}} <div data-id="{{$id}}" title="Afegir a preferits" class="favorito NotaNoFavorito fa fa-star"></div><i style="display:none;color:black;float:right;" class="paco fa fa-spinner fa-pulse fa-fw"></i>

        <?php } else { ?>
            {{$categories}} <div data-id="{{$id}}" title="Treure de preferits" class="favorito NotaFavorito fa fa-star"></div><i style="display:none;color:black;float:right;" class="paco fa fa-spinner fa-pulse fa-fw"></i>

        <?php } ?>
    </div>
</div>
