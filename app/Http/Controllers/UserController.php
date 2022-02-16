<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Pasos para validacion
        // 1. definir arreglo de reglas de validacion

        $reglas = [
            'nombre'     => 'required',           
            'apellidos'  => 'required|string',
            'username'   => 'required|unique:users,username', 
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
            
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/users/create")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $user = new User( $request->all() );            
        $user->password = Hash::make($request->password);
        $user->save();  

        Session::flash('message','Usuario Creado Exitosamente!!!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('userEdit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Pasos para validacion
        // 1. definir arreglo de reglas de validacion

        $reglas = [
            'nombre'     => 'required',           
            'apellidos'  => 'required|string',
            // 'username'   => 'required|unique:users,username', 
            // 'email'      => 'required|email|unique:users,email',
            'password'   => 'required',
            
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/users/$id/edit")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $user = User::find($id);
        $user->nombre    = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->username  = $request->username;
        $user->email     = $request->email;
        $user->password  = Hash::make($request->password);
        $user->save();  

        Session::flash('message','Usuario Editado Exitosamente!!!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
