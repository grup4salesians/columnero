<?php
$queryfavoritos = DB::table('valoracions')
        ->where('usuari_id', '=', Auth::user()->id)
        ->where('post_id', '=', $id)
        ->where('favorit', '=', 1)
        ->get();
?>
<div class="panel panel-default" data-date="{{ $data }}">
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
    <div class="panel-footer autor" style="background-color: #F9F9F9;">
        <a href="<?php echo Config::get('constants.BaseUrl'); ?>public/usuari/{{ $nick }}">{{ $nick }}</a>
    </div>
    <div class="panel-footer categories">
        <?php if (count($queryfavoritos) == 0) { ?>
            {{$categories}} <a href="<?php echo Config::get('constants.BaseUrl'); ?>public/afegir/{{ $id }}" style="text-decoration:none;float:right;margin-right:5px;font-size:20px;color:#86D2B6;" title="Afegir a preferits" class="fa fa-star"></a>

        <?php } else { ?>
            {{$categories}} <a href="<?php echo Config::get('constants.BaseUrl'); ?>public/treure/{{ $id }}" style="text-decoration:none;float:right;margin-right:5px;font-size:20px;color: gold;" title="Afegir a preferits" class="fa fa-star"></a>

        <?php }
        ?>
    </div>
</div>