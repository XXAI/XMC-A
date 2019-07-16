<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\carbon;
use \Validator, \Redirect;
use App\Models\Informacion, App\Models\LoginLog;

class InfoController extends Controller
{
    public function showInfo(Request $request){
        $usuario = Auth::user();

        $log = LoginLog::where('user_id',$usuario->id)->whereDate('fecha_login', Carbon::today())->first();

        if(!$log){
            $log = [
                    'user_id'=>$usuario->id,
                    'clues'=>$usuario->clues,
                    'ip'=>$request->ip()
                ];
            LoginLog::create($log);

            $usuario->load('informacion');
            return view('info',['datos'=>$usuario]);
        }else{
            return Redirect::to('http://saludchiapas.gob.mx');
        }
    }

    public function saveInfo(Request $request){
        $reglas = [
            'nombre' => 'required|max:255',
            'email' => 'nullable|email',
            //'telefono' => 'required',
            //'celular' => 'required',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre es requerido',
            //'telefono.required' => 'El telefono de oficina es requerido',
            //'celular.required' => 'El telefono celular es requerido',
            'email.email' => 'El correo electronico no tiene el formato correcto',
        ];

        $inputs = $request->all();

        $resultado = Validator::make($inputs,$reglas,$mensajes);

        if($resultado->passes()){
            $usuario = Auth::user();
            $inputs['user_id'] = $usuario->id;
            $inputs['clues'] = $usuario->clues;
            $registro = Informacion::create($inputs);
            return response()->json(['mensaje' => 'Guardado', 'validacion'=>$resultado->passes(), 'datos'=>$registro], HttpResponse::HTTP_OK);
        }else{
            return response()->json(['mensaje' => 'Error en los datos del formulario', 'validacion'=>$resultado->passes(), 'errores'=>$resultado->errors()], HttpResponse::HTTP_OK);
        }
    }

    public function updateInfo(Request $request,$id){
        $usuario = Auth::user();

        $registro = Informacion::find($id);

        if($registro->user_id != $usuario->id){
            return response()->json(['mensaje' => 'Error en los datos del formulario'], HttpResponse::HTTP_CONFLICT);
        }

        $reglas = [
            'nombre' => 'required|max:255',
            'email' => 'nullable|email',
        ];

        $mensajes = [
            'nombre.required' => 'El nombre es requerido',
            'email.email' => 'El correo electronico no tiene el formato correcto',
        ];

        $inputs = $request->all();

        $resultado = Validator::make($inputs,$reglas,$mensajes);

        if($resultado->passes()){
            $registro->nombre = $inputs['nombre'];
            $registro->email = $inputs['email'];
            $registro->telefono = $inputs['telefono'];
            $registro->celular = $inputs['celular'];
            $registro->save();

            return response()->json(['mensaje' => 'Guardado', 'validacion'=>$resultado->passes(), 'datos'=>$registro], HttpResponse::HTTP_OK);
        }else{
            return response()->json(['mensaje' => 'Error en los datos del formulario', 'validacion'=>$resultado->passes(), 'errores'=>$resultado->errors()], HttpResponse::HTTP_OK);
        }
    }

    public function doLogout(){
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
}
