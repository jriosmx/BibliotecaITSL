<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $rows = DB::table($request->table)->where($request->field,'LIKE','%'.$request->data_search.'%')->get();
            if($rows)
            {
                foreach ($rows as $key => $value) {
                    $cont=0;
                    foreach ($value as $field) {
                        if($cont == 1){
                            $output.="<tr>".
                                        "<th scope='row' style='width: 6%'>". $value->id."</th>
                                        <td style='width: 55%'>".$field."</td>.                        
                                        <td style='width: 1%'>
                                            <form action='/".$request->table."/".$value->id."/edit' method='get'>
                                                <button class='btn btn-outline-warning' type='submit'>Editar</button>
                                            </form>
                                        </td>
                                        <td style='width: 1%'>
                                            <form action='/".$request->table."/".$value->id."/edit' method='post'>
                                                <button class='btn btn-outline-danger' type='submit'>Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>";
                            break;
                        }
                        ++$cont;
                    }    
                }

                return Response($output);
            }
        }
    }

    public function searchLibros(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            
            $rows = DB::select(
                        DB::raw('
                                SELECT 
                                    libros.id, libros.ISBN, libros.titulo, libros.fechaDeLanzamiento, autores.autor, categorias.categoria,    
                                    editoriales.editorial, libros.idioma, libros.pagina, libros.descripcion 
                                FROM 
                                    libros, autores, categorias, editoriales 
                                WHERE 
                                    libros.idCategoria=categorias.id AND libros.idAutor=autores.id AND   
                                    libros.idEditorial=editoriales.id AND (libros.titulo LIKE "%'.$request->data_search.'%");                    
                        ')
                    );

            // dd($rows);
            if($rows)
            {
                foreach ($rows as $key => $value) {
                    $cont=0;
                    foreach ($value as $field) {
                        if($cont == 1){
                            $output.="<tr>".
                                       "<th class='text-center' scope='row' style='width: 2%'> $value->id       </th>
                                        <td class='text-center' style='width: 20%;'> $value->titulo             </td>
                                        <td class='text-center' style='width: 10%;'> $value->autor              </td>    
                                        <td class='text-center' style='width: 10%;'> $value->categoria          </td>    
                                        <td class='text-center' style='width: 10%;'> $value->editorial          </td>                                                   
                                        <td style='width:  1%'>
                                            <button class='btn btn-outline-info show-modal' data-toggle='modal' onclick='showModal('Informaci&oacute;n', 'hola', 'Confirm','$value->id')'>Detalles</button>
                                        </td> 
                                        <td style='width:  1%'>
                                            <form action='//libros//$value->id//edit' method='get'><button class='btn btn-outline-warning'
                                                    type='submit'>Editar</button>
                                            </form>
                                        </td>
                                        <td style='width: 1%'>
                                            <form action='//libros//$value->id//edit' method='post'><button
                                                    class='btn btn-outline-danger' type='submit'>Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>";
                            break;
                        }
                        ++$cont;
                    }    
                }

                return Response($output);
            }
        }
    }

    public function fetch(Request $request)
    {
        if( $request->ajax() )
        {
            $query = $request->get('query');

            // $data = DB::select(
            //             DB::raw("
            //                     SELECT autor FROM autores WHERE autor LIKE '%".$query."%';                                                   
            //             ")
            //         );

            // dd($request);

            $data = DB::table($request->table)
                        ->where($request->field, 'LIKE', "%{$query}%")
                        ->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                // foreach($data as $row)
                // {
                //     $output .= '
                //                 <li><a href="#">'.$row.'</a></li>
                //             ';
                // }
            
            $output .= '</ul>';

            echo $output;
            exit;
            // $output = '<ul class="dropdown-menu" style="display:block; position:relative">';                        
            // $output .= '
            //             <li><a href="#">'.$query.'</a></li>
            //         ';
            // $output .= '</ul>';

            // echo $output;
        }        
    }

}
