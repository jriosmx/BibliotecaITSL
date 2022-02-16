<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titulo}}</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            @if($titulo == 'Nuevo Libro')
                <a class="navbar-brand" href="/">&nbsp;&nbsp;< Volver </a>
            @else
                <a class="navbar-brand" href="/libros">&nbsp;&nbsp;< Volver </a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    </nav>

    <div class="mx-auto col-6 offset-3 mt-4">

                    @if(Session::has('message'))
                        @if($titulo == 'Nuevo Libro')
                            <div class="alert alert-success alert-dismissible alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/';"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('message')}}
                            </div>
                        @else
                            <div class="alert alert-success alert-dismissible alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/libros';"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('message')}}
                            </div>
                        @endif
                    @endif

                </div>

    <div class="container">
        
    </div>
    <div class="container">
        <div class="mx-auto col-6">
            <h1 class="display-4 mt-3 text-center">{{$titulo}}</h1> 
            @if($titulo == 'Nuevo Libro')
                <form action="/libros" method="post" class="needs-validation" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" --> <!-- agregar para cargar la imagen -->
            @else
                <form action="/libros/{{$libro->id}}" method="post" class="needs-validation" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" --> <!-- agregar para cargar la imagen -->
                @method('PUT')
            @endif    
                                
                <div class="row " >
                    <div class="col text-center">
                        <div class="mt-5 mb-3">                            
                                <table style="margin:auto;">                            
                                    <tr>	   
                                        @if($titulo == 'Nuevo Libro')                                                          
                                            <td><img id="img" name="img" src="#"  width="200" height="200"></td> <!-- width="150" height="130" -->
                                        @else                                                                                                                 
                                            <td><img id="img" name="img" src="<?php echo 'data:image/jpeg;base64,'.base64_encode($portada).'';?>" width="200" height="300"></td> <!-- width="150" height="130" -->
                                        @endif
                                    </tr>
                                    <tr>
                                        <td >Foto de Portada</td>
                                    </tr>		 
                                    <tr>
                                        <td >
                                            <div class="validate-input" data-validate="Escoge una imagen de portada" >	
                                                <input class='form-control' accept = 'image/jpg, image/png' id="imgload" type="file" name="foto" size="27">
                                            </div>
                                        </td>
                                    </tr>
                                </table>  
                                              
                            @error('portada')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>

                <div class="row" >
                    <div class="col">
                        <div class="mb-3">
                            <label for="ISBN" class="form-label">ISBN</label>
                            <input type="text" class="form-control @error('ISBN') is-invalid @endError" id="ISBN"
                                name="ISBN" value="{{old('ISBN', $libro->ISBN ?? '')}}">
                            @error('ISBN')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>     

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" class="form-control @error('titulo') is-invalid @endError" id="titulo"
                                name="titulo" value="{{old('titulo', $libro->titulo ?? '')}}">
                            @error('titulo')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>   
                
                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="fechaDeLanzamiento" class="form-label">Fecha de Lanzamiento</label>
                            <input type="date" class="form-control @error('fechaDeLanzamiento') is-invalid @endError" id="fechaDeLanzamiento"
                                name="fechaDeLanzamiento" value="{{old('fechaDeLanzamiento', $libro->fechaDeLanzamiento ?? '')}}">
                            @error('fechaDeLanzamiento')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>   
                
                <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor</label>
                            <input type="text" class="form-control @error('autor') is-invalid @endError" id="autor"
                                name="autor" value="{{old('autor', $autor ?? '')}}">
                            @error('autor')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                            <div id="autorList">
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <input type="text" class="form-control @error('categoria') is-invalid @endError" id="categoria"
                                name="categoria" value="{{old('categoria', $categoria ?? '')}}">
                            @error('categoria')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                            <div id="categoriaList">
                            </div>
                        </div>
                    </div>
                </div>   

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="editorial" class="form-label">Editorial</label>
                            <input type="text" class="form-control @error('editorial') is-invalid @endError" id="editorial"
                                name="editorial" value="{{old('editorial', $editorial ?? '')}}">
                            @error('editorial')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                            <div id="editorialList">
                            </div>
                        </div>
                    </div>
                </div>   

                <input type="hidden" name="idEditorial">

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="idioma" class="form-label">Idioma</label>
                            <input type="text" class="form-control @error('idioma') is-invalid @endError" id="idioma"
                                name="idioma" value="{{old('idioma', $libro->idioma ?? '')}}">
                            @error('idioma')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>   

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="pagina" class="form-label">Páginas</label>
                            <input type="number" class="form-control @error('pagina') is-invalid @endError" id="pagina"
                                name="pagina" value="{{old('pagina', $libro->pagina ?? '0')}}">
                            @error('pagina')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>   

                <div class="row " >
                    <div class="col">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea  class="form-control @error('descripcion') is-invalid @endError" rows="4" cols="50" id="descripcion" name="descripcion">
                                {{old('descripcion', $libro->descripcion ?? '')}}
                            </textarea>
                            @error('descripcion')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>                                                                

                <div class="container-button h-100 mb-5" > 
    		        <div class="row w-100 align-items-center">
    			        <div class="col text-center">
                            @if(Session::has('message'))
                                <button class="btn btn-primary display: flex; justify-content: center;" type="submit" disabled>Enviar</button>
                            @else
                                <button class="btn btn-primary display: flex; justify-content: center;" type="submit" >Enviar</button>
                            @endif
                        </div>
                    </div>
                </div> 

            </form>
        </div>
    </div>    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function(){        

        $('input').attr('autocomplete','off');  // desactiva el autocomplete en cada input text

        function loadImg(id){
            var data = 'id='+id;
            // console.log("data:" + data);

            $.ajax({ 
                type:      'POST',
                // url:       'queryImage.php?productID='+id+'',
                url:       "{{ route('img') }}",                
                // url: "/Users/mac/Documents/Server/Projects/BibliotecaITSL/app/Http/Controllers/queryImage.php",
                data:      data,
                dataType:  'json',
                success: function(data){
                            
                    $('#img').attr('src','data:image/jpg;charset=utf8;base64,'+data.picture); 
                    console.log(data.picture);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus + " Error:" + errorThrown);
                }
            });
        }

    // carga los `Autores`
    $('#autor').keyup(function(){ 
                                   
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:    "{{ route('autocompletefetch') }}",
                    method: "POST",
                    data:   { query:query, _token:_token, 'table':'autores', 'field':'autor'},
                        success:function(data){
                           
                            $('#autorList').fadeIn();  
                            $('#autorList').html(data);
                        }
                });
            }else{
                $('#autorList').hide();  // esconde el dropdown
            }
    });
    
    $('#autorList').on('click', 'li', function(){  
        $('#autor').val($(this).text());  
        $('#autorList').fadeOut();  
    });  

    // carga las `Categorias`
    $('#categoria').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('autocompletefetch') }}",
                    method:"POST",
                    data:{ query:query, _token:_token, 'table':'categorias', 'field':'categoria'},
                        success:function(data){
                            $('#categoriaList').fadeIn();  
                            $('#categoriaList').html(data);
                        }
                });
            }else{
                $('#categoriaList').hide();  // esconde el dropdown
            }
    });
    $('#categoriaList').on('click', 'li', function(){  
        $('#categoria').val($(this).text());  
        $('#categoriaList').fadeOut();  
    });
    
    // carga las `Editoriales`
    $('#editorial').keyup(function(){ 
            var query = $(this).val();
            if(query != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:    "{{ route('autocompletefetch') }}",
                    method: "POST",
                    data:{  query:query, _token:_token, 'table':'editoriales', 'field':'editorial'},
                        success:function(data){
                            $('#editorialList').fadeIn();  
                            $('#editorialList').html(data);
                        }
                });
            }else{
                $('#editorialList').hide();  // esconde el dropdown
            }
    });
        $('#editorialList').on('click', 'li', function(){  
            $('#editorial').val($(this).text());  
            $('#editorialList').fadeOut();  
        });

        //esta funcion carga la imagen
		$("#imgload").change(function () {
			if (this.files && this.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#img').attr('src', e.target.result);
					
				}
				reader.readAsDataURL(this.files[0]);
			}
    	});

    });
</script>

</body>
</html>
