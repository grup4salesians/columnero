
<div id='busqueda_home' data-column-id="{{ $idCategoria }}" style="display: none;">
    <div id='ordenar_home'>
        <i id="show-ordenar_home" class="fa fa-times"></i>
        {{ Form::open(array('url' => '/cercarhome')) }}
        <fieldset>
            <legend>Ordenar per</legend>
            <span class='titulsbusqueda'>Millor valorats</span> <input id="millorvalorats" name="millorvalorats" type="checkbox">
            <span class='titulsbusqueda'>Tots</span> <input  name="radio1" value="tots" checked="checked" id="filtrocheckbox" type="radio">
            <span class='titulsbusqueda'>Setmana</span> <input name="radio1" value="setmana" id="filtrocheckbox" type="radio">
            <span class='titulsbusqueda'>Mes</span> <input name="radio1" value="mes" id="filtrocheckbox"  type="radio">
            <button id="ordenarTitulo">Ordenar por Títutlo</button>
            <input type="submit" class="btn btn-default" value="Enviar">
        </fieldset>
        {{ Form::close() }}
    </div>
</div>