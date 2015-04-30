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
                    This is a free bootstrap admin template with basic pages you need to craft your project. 
                    Use this template for free to use for personal and commercial use.
                    <br />
                    <strong> Some of its features are given below :</strong>
                    <ul>
                        <li>
                            Responsive Design Framework Used
                        </li>
                        <li>
                            Easy to use and customize
                        </li>
                        <li>
                            Font awesome icons included
                        </li>
                        <li>
                            Clean and light code used.
                        </li>
                    </ul>

                </div>
                <div class="alert alert-success">
                    <strong> Instructions To Use:</strong>
                    <ul>
                        <li>
                            Lorem ipsum dolor sit amet ipsum dolor sit ame
                        </li>
                        <li>
                            Aamet ipsum dolor sit ame
                        </li>
                        <li>
                            Lorem ipsum dolor sit amet ipsum dolor
                        </li>
                        <li>
                            Cpsum dolor sit ame
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>