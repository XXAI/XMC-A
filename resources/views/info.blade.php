<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>México Conectado: Login</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
        <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
        <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/modules/informacion.js')}}"></script>
    </head>
    <body>
        <div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <img src="{{asset('images/LOGOS-01.jpg')}}" class="img-fluid" alt="Responsive image">
                    </div>
                    <div class="col-6">
                    </div>
                    <div class="col-3">
                        <img src="{{asset('images/LOGOS-03.jpg')}}" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 offset-sm-1 col-sm-10">
                        <form id="form-info"> <!-- action="{{url('guardar')}}" method="post" -->
                            @csrf <!-- {{ csrf_field() }} -->
                            <input type="hidden" id="id" value="{{($datos->informacion)?$datos->informacion->id:''}}">
                            <div class="card">
                                <div class="card-header text-center text-white bg-info">
                                    <h5 class="card-title">
                                        Información del Responsable
                                        <a href="logout" class="close" aria-label="Close><span aria-hidden="true">&times;</span></a>
                                    </h5>
                                </div>    
                                <div class="card-body border-info text-info">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{($datos->informacion)?$datos->informacion->nombre:''}}">
                                        <div id="error_nombre" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Correo Electronico</label>
                                        <input type="email" class="form-control" name="email" id="email" value="{{($datos->informacion)?$datos->informacion->email:''}}">
                                        <div id="error_email" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" value="{{($datos->informacion)?$datos->informacion->telefono:''}}">
                                        <div id="error_telefono" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Celular</label>
                                        <input type="text" class="form-control" name="celular" id="celular" value="{{($datos->informacion)?$datos->informacion->celular:''}}">
                                        <div id="error_celular" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="card-footer text-white bg-light">
                                    <button class="btn btn-primary btn-block" type="button" onclick="enviarFormulario()"><i class="fas fa-save"></i> Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </body>
</html>