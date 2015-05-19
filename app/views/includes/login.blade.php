<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Iniciar sessió</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if(Session::has('mensaje_error'))
                    <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
                @endif
                        
                
                {{ Form::open(array('url' => '/login')) }}
                <div>
                    {{ Form::label('email', 'Correu') }}
                    {{ Form::text('email', Input::old('email'),array('class' => 'form-control')) }}
                </div>
                <div >
                    {{ Form::label('password', 'Contrasenya') }}
                    {{ Form::password('password',array('class' => 'form-control')); }}
                </div>
                <div class="checkbox">
                    <label> 
                        {{ Form::checkbox('rememberme', true) }}    Recordar contrasenya 
                    </label>
                </div>
                {{ Form::submit('Enviar', array('class' => 'btn btn-primary'))}}
                {{ Form::close() }}
            </div>
            <div class="col-md-6">
                <div class="alert alert-info">
                    Aquesta és una pàgina gratuïta! Esperem que la nostre web et sigui útil!.
                    <br />
                    <strong> Algunes de les característiques s'esmenten a continuació:</strong>
                    <ul>
                        <li>
                           Columnes pròpies per a cada usuari.
                        </li>
                        <li>
                           Fàcil d'utilitzar i personalitzar!
                        </li>
                        <li>
                            Llistes de preferits i privacitat.
                        </li>
                      
                    </ul>

                </div>
                <div class="alert alert-success">
                    <strong> Instruccions d'ús:</strong>
                    <ul>
                        <li>
                            Registra't a la pàgina
                        </li>
                        <li>
                            Crea una nova columna
                        </li>
                        <li>
                            Fes-la pública o privada
                        </li>
                        <li>
                            Ordena-la per categories
                        </li>
                        <li>
                            Afegeix el contingut que vulguis
                        </li>
                        <li>
                            Guarda, i ja tens la teva primera columna!
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>