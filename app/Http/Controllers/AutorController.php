<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::All();
        return view('autores',['autores' => $autores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autorCreate', ['titulo' => 'Nuevo Autor']);
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
            'autor'     => 'required',                       
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/autores/create")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $autor = new Autor( $request->all() );            
        $autor->save();  

        Session::flash('message','Autor Creado Exitosamente!!!');
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
    public function edit($id)
    {
        $autor = Autor::findOrFail($id);
        return view('autorCreate', ['autor' => $autor, 'titulo' => 'Editar Autor']);
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
            'autor'     => 'required',                       
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/autores/$id/edit")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $autor = Autor::find($id);        
        $autor->autor = $request->autor;    
        $autor->save();  

        Session::flash('message','Autor Editado Exitosamente!!!');
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

    /**
     * Regresa el `id` del `Autor`
     */

    public function getId(Request $request){
        $autor = Autor::where('autor','Like', $request->autor)->get();
        return $autor->id;
    }
}
