<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function mostrarFormulario(Request $request){
        return view('login');
    }

    public function login(Request $request){

        $reglas = [
            'email'    => 'required|email',                     
            'password' => 'required'            
        ];

        $validator = Validator::make($request->input(), $reglas);

        if( $validator->fails() ){
            return  redirect("/login")->withErrors($validator)->withInput($request->all());
        }

        $credenciales = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        // si las credenciales son correctas 
        if( Auth::attempt($credenciales) ){
                Auth::user()->username;

                return redirect('/');
        }
              
        Session::flash('message','Credenciales invalidas!!!');
        return back();
    }

    public function logout(){
        // cerrar la sesion
        Auth::logout();
        //redigirir a la raiz de la pagina
        return redirect('/');
    }
}
