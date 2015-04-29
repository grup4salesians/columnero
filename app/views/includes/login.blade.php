<div class="panel panel-default">
    <div class="panel-body" style="width: 240px; margin: auto;">
        @if(Session::has('mensaje_error'))
        <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
        @endif
        {{ Form::open(array('url' => '/login')) }}
        <legend>Iniciar sesión</legend>
        <div class="form-group">
            {{ Form::label('correu', 'Correu') }}
            {{ Form::text('correu', Input::old('correu')) }}
        </div>
        <div class="form-group">
            {{ Form::label('contraseña', 'Contraseña') }}
            {{ Form::password('password'); }}
        </div>
        <div class="checkbox">
            <label> 
                {{ Form::checkbox('rememberme', true) }}    Recordar contraseña 
            </label>
        </div>
        {{ Form::submit('Enviar', array('class' => 'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
</div>