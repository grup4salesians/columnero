<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">Logejat</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if(Session::has('mensaje_error'))
                    <div class="alert alert-danger">{{ Session::get('mensaje_error') }}</div>
                @endif
                
               <?php
                $u = Usuari::where('id', 2)->get();
                echo $u[0]->nom;
?>
                
                
                {{ Form::open(array('url' => '/login')) }}
                <div>
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', Input::old('email'),array('class' => 'form-control')) }}
                </div>
                <div >
                    {{ Form::label('contraseña', 'Contrasenya') }}
                    {{ Form::password('contrasenya',array('class' => 'form-control')); }}
                </div>
                <div class="checkbox">
                    <label> 
                        {{ Form::checkbox('rememberme', true) }}    Recordar contraseña 
                    </label>
                </div>
                {{ Form::submit('Enviar', array('class' => 'btn btn-primary'))}}
                {{ Form::close() }}
            </div>
            <div class="col-md-6">
                <div class="alert alert-info">
                    Aquesta es una pagina gratuita de Columner! Esperem que disfrutis de la teva estancia!.
                    <br />
                    <strong> Algunes de les caracteristiques del columner s'esmenten aquí a baix :</strong>
                    <ul>
                        <li>
                           Columnes propies per a cada usuari.
                        </li>
                        <li>
                           ¡Fácil d'utilitzar i costumitzar!
                        </li>
                        <li>
                            Inclueix els millors com a favorits!
                        </li>
                      
                    </ul>

                </div>
                <div class="alert alert-success">
                    <strong> Instruccions d'ús:</strong>
                    <ul>
                        <li>
                            Registra't a la página
                        </li>
                        <li>
                            Crea una nova columna
                        </li>
                        <li>
                            Modifica la teva columna amb el que vulguis
                        </li>
                        <li>
                            Guarda!
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>