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
    </head>
    <body>
        <div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-3">
                        <img src="{{asset('images/LOGOS-01.jpg')}}" class="img-fluid" alt="Responsive image">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="offset-lg-4 col-lg-4 offset-md-3 col-md-6">
                        <div class="card">
                            <div class="card-header text-center">
                                <h5 class="card-title">Iniciar Sesión</h5>
                            </div>
                            <form action="{{url('sign-in')}}" method="post">
                            @csrf <!-- {{ csrf_field() }} -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <input type="text" class="form-control" name="user" id="user">
                                        <div id="error_user" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                        <div id="error_password" class="invalid-feedback"></div>
                                    </div>
                                </div>
                                <div class="card-footer captura-formulario">
                                    <button class="btn btn-primary btn-block" type="submit">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </body>
</html>