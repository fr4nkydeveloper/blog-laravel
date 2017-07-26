   <!--Iteramos sobre los errores que se obtuvieron-->
    <!--Usando la funcion withErros en la ruta laravel automaticamente provee helpers o variables para acceder a 
    los errores-->

    @if(count($errors->all()))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger">
                <ul>
                     @foreach($errors->all() as $error)
                         <!--El mensaje de los errores se encuentra en resources/lang/en/validation.php-->
                         <li>{{ $error }}</li>
                     @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif