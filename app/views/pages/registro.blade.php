@extends('layouts.master')
@section('title')
Registre
@stop
@section('content')
<div class="body_registre">
     
    <div class="panel-body" style="width: 390px; margin: auto;background-color:rgba(217, 83, 79, 0.02)">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Registra't</h4>
            </div>
        </div>
        @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>        
            @endforeach
        </div>
        @endif
        {{ Form::open(array('url' => '/registro','method' => 'post')) }}
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
            {{ Form::text('nick', Input::old('nick'),array('class' => 'Registre_TextBox')) }}
        </div>
        <br>
        {{ Form::submit('Registra\'t!',array('class'=> 'btn btn-success'))}}
        {{ Form::close() }}
    </div>
</div>
@stop

