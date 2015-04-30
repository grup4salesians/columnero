@extends('layouts.master')
@section('title')
Registre
@stop
@section('content')
<div class="panel-body" style="width: 390px; margin: auto;">
    @if ($errors->has())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>        
        @endforeach
    </div>
    @endif
    {{ Form::open(array('url' => '/registro')) }}
    <div class="form-group">
        {{ Form::label('Nom', 'Nom') }}
        {{ Form::text('nom', Input::old('nom'),array('class' => 'Registre_TextBox')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Cognoms', 'Cognoms') }}
        {{ Form::text('cognoms', Input::old('cognoms'),array('class' => 'Registre_TextBox')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Correu', 'Correu') }}
        {{ Form::text('correu', Input::old('correu'),array('class' => 'Registre_TextBox')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Contrasenya', 'Contrasenya') }}
        {{ Form::password('password',array('class' => 'Registre_TextBox')) }}
    </div>
    <div class="form-group">
        {{ Form::label('Repetir contrasenya', 'Repetir contrasenya') }}
        {{ Form::password('contrasenya_confirm',array('class' => 'Registre_TextBox')) }}
    </div>
     <div class="form-group">
        {{ Form::label('Nick', 'Nick') }}
        {{ Form::text('Nick', Input::old('nick'),array('class' => 'Registre_TextBox')) }}
    </div>
    <div class="checkbox" style="margin-left: 23px;">
        {{ Form::checkbox('chkRegistreCondicions', true) }}     
        Accepto les <a href="#">condicions d'ús</a>
    </div>

    {{ Form::submit('Registra\'t!',array('class'=> 'btn btn-default'))}}
    {{ Form::close() }}
</div>
@stop

