<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::All();
        return view('categorias',['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoriaCreate',['titulo' => 'Nueva Categoría']);
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
            'categoria' => 'required',                       
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/categorias/create")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $categoria = new Categoria( $request->all() );            
        $categoria->save();  

        Session::flash('message','Categoría Creado Exitosamente!!!');
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
        $categoria = Categoria::findOrFail($id);
        return view('categoriaCreate', ['categoria' => $categoria, 'titulo' => 'Editar Categoria']);
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
            'categoria' => 'required',                       
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/categorias/$id/edit")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $categoria = Categoria::find($id);        
        $categoria->categoria = $request->categoria;    
        $categoria->save();  

        Session::flash('message','Categoría Editada Exitosamente!!!');
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
