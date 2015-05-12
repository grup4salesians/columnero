
<div id='busqueda_home' data-column-id="{{ $idCategoria }}" style="display: none;">
    <div id='ordenar_home'>
        <i id="show-ordenar_home" class="fa fa-times"></i>
        {{ Form::open(array('url' => '/cercarhome')) }}
        <fieldset>
            <legend>Ordenar per</legend>
            <input class="search-{{ $idCategoria }}" placeholder="Search" />
            <button id="ordenarTitulo">Ordenar por Títutlo</button>
            <button id="ordenarFecha">Ordenar por Fecha</button>
        </fieldset>
        {{ Form::close() }}
    </div>
</div>