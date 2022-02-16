<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editoriales = Editorial::All();
        return view('editoriales',['editoriales' => $editoriales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('editorial', ['titulo' => 'Nueva Editorial']);
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
            'editorial' => 'required',                       
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/editorial/create")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $editorial = new Editorial( $request->all() );            
        $editorial->save();  

        Session::flash('message','Editorial Creada Exitosamente!!!');
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
        $editorial = Editorial::findOrFail($id);
        return view('editorial', ['editorial' => $editorial, 'titulo' => 'Editar Editorial']);
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
            'editorial' => 'required',                       
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/editoriales/$id/edit")->withErrors($validator)->withInput($request->all());
        }

        // 4. Guardar al user
        $editorial = Editorial::find($id);        
        $editorial->editorial = $request->editorial;    
        $editorial->save();  

        Session::flash('message','Editorial Editada Exitosamente!!!');
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
