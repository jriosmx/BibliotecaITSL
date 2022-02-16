<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $libros = DB::select(
                        DB::raw('
                            SELECT 
                                libros.id, libros.ISBN, libros.titulo, libros.fechaDeLanzamiento, autores.autor, categorias.categoria, editoriales.editorial, libros.idioma, libros.pagina, libros.descripcion
                            FROM
                                libros,autores,categorias,editoriales
                            WHERE
                                libros.idAutor = autores.id   
                            AND
                                libros.idCategoria = categorias.id
                            AND
                                libros.idEditorial = editoriales.id
                         ')
                    );
        // dd($libros);

        return view('libros',['libros' => $libros, 'titulo' => 'Ver Libros']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libro', ['titulo' => 'Nuevo Libro']);
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
            'ISBN'                => 'required',
            'titulo'              => 'required',  
            'fechaDeLanzamiento'  => ['required','date_format:Y-m-d'],
            'autor'               => 'required|string',
            'categoria'           => 'required|string',
            'editorial'           => 'required|string',
            'idioma'              => 'required',
            'pagina'              => 'required|integer|gte:0',
            'descripcion'         => 'required'
            // 'portada'             => 'required'                      
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/libros/create")->withErrors($validator)->withInput($request->all());
        }

        /**
        * Regresa los `id's` del `Autor`, `Categoria` y `Editorial`
        */

        $autor     = DB::table('autores'    )->select('id as id')->where('autor',     '=', $request->autor    )->get();
        $categoria = DB::table('categorias' )->select('id as id')->where('categoria', '=', $request->categoria)->get();
        $editorial = DB::table('editoriales')->select('id as id')->where('editorial', '=', $request->editorial)->get();
        
        // 4. Guardar al user
        // $buffer   = addslashes( file_get_contents( $_FILES["foto"]["tmp_name"] ) );
        $buffer   =  file_get_contents( $_FILES["foto"]["tmp_name"] ) ;

        $libro = new Libro( $request->all() ); 
        $libro->idAutor     = $autor[0]->id; 
        $libro->idCategoria = $categoria[0]->id; 
        $libro->idEditorial = $editorial[0]->id;        
        $libro->pagina      = (int)$request->pagina; 
        $libro->portada     = $buffer;    
        // dd($libro);
        $libro->save();  

        Session::flash('message','Libro Creado Exitosamente!!!');
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
        $libro = Libro::findOrFail($id);

        $query = DB::select(
            DB::raw('
                SELECT 
                    autores.autor, categorias.categoria, editoriales.editorial, libros.portada
                FROM
                    libros,autores,categorias,editoriales
                WHERE
                    libros.idAutor = autores.id   
                AND
                    libros.idCategoria = categorias.id
                AND
                    libros.idEditorial = editoriales.id   
                AND
                    libros.id = '.$id.'          
             ')
        );
        
        return view('libro', ['libro' => $libro, 'titulo' => 'Editar Libro', 'autor' => $query[0]->autor, 'categoria' => $query[0]->categoria, 'editorial' => $query[0]->editorial, 'portada' => $query[0]->portada]);
    
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
            'ISBN'                => 'required',
            'titulo'              => 'required',  
            'fechaDeLanzamiento'  => ['required','date_format:Y-m-d'],
            'autor'               => 'required|string',
            'categoria'           => 'required|string',
            'editorial'           => 'required|string',
            'idioma'              => 'required',
            'pagina'              => 'required|integer|gte:0',
            'descripcion'         => 'required'
            // 'portada'             => 'required'                      
        ];

        // 2. Implementar las reglas
        $validator = Validator::make($request->input(), $reglas);                

        // 3. ejecutar validator
        if( $validator->fails() ){
            return  redirect("/libros/$id/edit")->withErrors($validator)->withInput($request->all());
        }

        $buffer   =  file_get_contents( $_FILES["foto"]["tmp_name"] ) ;

        // dd($buffer);

        $portada  = "";
        if( $buffer ){
            $portada = $buffer;
        }else{
            $portada = $request->portada;
        }

         /**
        * Regresa los `id's` del `Autor`, `Categoria` y `Editorial`
        */

        $autor     = DB::table('autores'    )->select('id as id')->where('autor',     '=', $request->autor    )->get();
        $categoria = DB::table('categorias' )->select('id as id')->where('categoria', '=', $request->categoria)->get();
        $editorial = DB::table('editoriales')->select('id as id')->where('editorial', '=', $request->editorial)->get();
    

        // 4. Guardar al user
        $libro =  Libro::find($id);     
        $libro->ISBN               = $request->ISBN; 
        $libro->titulo             = $request->titulo; 
        $libro->fechaDeLanzamiento = $request->fechaDeLanzamiento; 
        $libro->idAutor            = $autor[0]->id; 
        $libro->idCategoria        = $categoria[0]->id; 
        $libro->idEditorial        = $editorial[0]->id; 
        $libro->idioma             = $request->idioma; 
        $libro->pagina             = $request->pagina;       
        $libro->descripcion        = $request->descripcion;       
        $libro->portada            = $portada;          
        $libro->save();  

        Session::flash('message','Libro Editado Exitosamente!!!');
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
    
    public function fetch(Request $request)
    {
        if( $request->ajax() )
        {
            
            if($request->get('query')){
                $query = $request->get('query');
                // $table = $request->get('table');
                // $field = $request->get('field');

                $data = DB::table($request->table)
                            ->where($request->field, 'LIKE', "%{$query}%")
                            ->get();

                $output = '<ul name='.$request->field.' id='.$request->field.' class="dropdown-menu" style="display:block; position:relative">';
                    foreach($data as $row)
                    {
                        if( strcmp($request->field, "autor"    ) == 0 ){ $output .= '<li><a href="#">'.$row->autor    .'</a></li>';}
                        if( strcmp($request->field, "categoria") == 0 ){ $output .= '<li><a href="#">'.$row->categoria.'</a></li>';}
                        if( strcmp($request->field, "editorial") == 0 ){ $output .= '<li><a href="#">'.$row->editorial.'</a></li>';}
                    }
                
                $output .= '</ul>';

                echo $output;
                exit;
            }
        }
    }
    
    public function detail(Request $request){

        if($request->ajax())
        {            
            $output="";
            
            $row = DB::select(
                DB::raw('
                    SELECT 
                        libros.id, libros.ISBN, libros.titulo, libros.fechaDeLanzamiento, autores.autor, categorias.categoria, editoriales.editorial, libros.idioma, libros.pagina, libros.descripcion
                    FROM
                        libros,autores,categorias,editoriales
                    WHERE
                        libros.idAutor = autores.id   
                    AND
                        libros.idCategoria = categorias.id
                    AND
                        libros.idEditorial = editoriales.id
                    AND 
                        libros.id = '.$request->id.';
                 ')
            );
    
            // dd($row);

            if($row)
            {
                // $output = $row[0]->ISBN;
                
                // $output.="
                //     <div class='row' >
                //         <div class='col'>
                //             <div class='mb-3'>
                //                 <label for='ISBN' class='form-label'>".$row[0]->ISBN."</label>
                //                 <input type='text' class='form-control' id='ISBN' name='ISBN' value=''>                           
                //             </div>
                //         </div>
                //     </div>                                  
                // ";            
                           

                return Response($row);
            }
        }
    } 

}
