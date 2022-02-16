<?php 

// clear the old headers

use Illuminate\Support\Facades\DB;

header_remove();
// set the actual code
http_response_code(200);
// set the header to make sure cache is forced
header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
// treat this as json
header('Content-Type: application/json');

if( isset( $_POST['id'] ) )
{
   
    $id = trim( $_POST['id'] ); 
  
    $query = DB::select(
        DB::raw('
            SELECT 
                libros.portada
            FROM
                libros
            WHERE                
                libros.id = '.$id.'
         ')
    );

	// dd($query);
   
    $jsondata = array();
    $jsondata = array( "picture" => base64_encode( $query[0]->portada ) );
    
    echo json_encode($jsondata, JSON_FORCE_OBJECT);

    exit;
}  

?>