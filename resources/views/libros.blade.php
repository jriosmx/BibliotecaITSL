<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
     
   <title>{{$titulo}}</title> 
</head>

<body>    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand" href="/">&nbsp;&nbsp;< Volver </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    </nav>


    <div class="container mt-3">
        <h1 class="display-4 text-center">{{$titulo}}</h1>
        <div class="container-fluid ">
            <div class="row d-flex justify-content-center">
                <div class="col-md-10">

                    <!-- <form method="GET" action="{{ route('getAutores') }}"> -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-4">
                            <div class="input-group mt-5 mb-5">
                                <input type="search" class="form-control rounded " placeholder="Search" aria-label="Search" aria-describedby="search-addon" 
                                    name="libro_search" id="libro_search" value="{{ old('libro_search') }}"/>
                                <button type="button" class="btn btn-outline-primary" onclick="search()">search</button>
                            </div>
                        </div>
                    </div>
                    <!-- </form> -->

                    @if($libros)
                        <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Id</th>                        
                                <!-- <th class="text-center" scope="col">ISBN</th> -->  
                                <th class="text-center" scope="col">Título</th>
                                <!-- <th class="text-center" scope="col">Fecha de Lanzamiento</th> -->
                                <th class="text-center" scope="col">Autor</th>
                                <th class="text-center" scope="col">Categoria</th>
                                <th class="text-center" scope="col">Editorial</th>
                                <!-- <th class="text-center" scope="col">Idioma</th> -->
                                <!-- <th class="text-center" scope="col">Páginas</th> -->
                                <th scope="col">Acciones</th>                                            
                            </tr>   
                        </thead>
                        <tbody>
                            @foreach($libros as $libro)
                            <tr>
                                <th class="text-center" scope="row" style="width: 2%">{{ $libro->id }}      </th>
                                <!-- <td class="text-center" style="width: 5%">{{ $libro->ISBN }}               </td>  -->   
                                <td class="text-center" style="width: 20%;">{{ $libro->titulo }}            </td>
                               <!--  <td class="text-center" style="width: 10%;">{{ $libro->fechaDeLanzamiento }}</td> -->
                                <td class="text-center" style="width: 10%;">{{ $libro->autor }}             </td>    
                                <td class="text-center" style="width: 10%;">{{ $libro->categoria }}         </td>    
                                <td class="text-center" style="width: 10%;">{{ $libro->editorial }}         </td>    
                                <!-- <td class="text-center" style="width:  5%;">{{ $libro->idioma }}            </td> -->
                               <!--  <td class="text-center"style="width:  5%;">{{ $libro->pagina }}            </td>      -->                   
                               <td style="width:  1%">
                                    <!-- <form action="/libros/{{$libro->id}}/show" method="get"> -->
                                        <button class="btn btn-outline-info show-modal" data-toggle="modal" onclick="showModal('Informaci&oacute;n', 'hola', 'Confirm',<?php echo $libro->id ?>)">Detalles</button>  <!-- data-target="#staticBackdrop" -->
                                    <!-- </form> -->
                               </td> 
                               <td style="width:  1%">
                                    <form action="/libros/{{$libro->id}}/edit" method="get"><button class="btn btn-outline-warning"
                                            type="submit">Editar</button>
                                    </form>
                                </td>
                                <td style="width: 1%">
                                    <form action="/libros/{{$libro->id}}/edit" method="post">@method('DELETE')<button
                                            class="btn btn-outline-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        {{Session::flash('message','No tienes `Libros` registrados!!!');}}
                        <div class="container">
                            <div class="mx-auto col-6 offset-3 mt-4">

                            @if(Session::has('message'))
                                <div class="alert alert-info alert-dismissible alert-block" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/';"><span aria-hidden="true">&times;</span></button>
                                    {{Session::get('message')}}
                                </div>
                            @endif

                            </div>
                        </div>
                        <!-- <h1 class="display-6 text-center mt-3">No tienes `Autores` registrados</h1> -->
                    
                    @endif

                </div>
            </div>
        </div>
    </div>    

    <script type="text/javascript">
        $('#libro_search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : "{{URL::to('getLibros')}}",
                data: {'data_search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        });

        function search(){
            $value = $('#libro_search').val();
            $.ajax({
                type : 'get',
                url : "{{URL::to('getLibros')}}",
                data: {'data_search':$value},
                    success:function(data){
                        $('tbody').html(data);
                    }
            });
        }       
       
        function showModal(heading, message, okButtonTxt,id) {
	
            var modal = 
                $( '<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true"> '+
                        '<div class="modal-dialog" role="document">' +
                            '<div class="modal-content">' +
                            '<div class="modal-header">' +
                                '<h5 class="modal-title" id="staticBackdropLabel">'+heading+'</h5>' +
                                '<button id="close" type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span>' +
                            ' </button>' +
                            '</div>' +
                            '<div id="data" class="modal-body">' +
                                // '<p>'+message+'</p>' +
                            '</div>' +
                            '<div class="modal-footer">' +
                                /* '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>' + */
                                '<button id="okButton" type="button" class="btn btn-primary">Ok</button>' +
                            '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>');

            

            modal.find('#okButton').click(function(event) {
                // var node= document.getElementById("data");
                // node.querySelectorAll('*').forEach(n => n.remove());

                modal.modal('hide');	 		
            });

            modal.find('#close').click(function(event) {
                // var node= document.getElementById("data");
                // node.querySelectorAll('*').forEach(n => n.remove());
                
                modal.modal('hide');	                	
            });
                
            modal.modal('show');     

            modal.on('shown.bs.modal', function() {
                    $("#okButton",this).focus();   
            });

            addData(id);
	
        };

        var addToDiv = function (data) {
        var node = document.createElement("LI");
        var textnode = document.createTextNode(JSON.stringify(data[0].titulo));
        node.appendChild(textnode);
        document.getElementById("data").appendChild(node);
        };

        function addData(id){
            console.log("id:" + id);
            $.ajax({
                type : 'get',
                url : "{{ route('getDetail') }}", 
                data: {"id":id},
                    success:function(data){
                        // document.getElementById('#data').appendChild($.parseHTML(data));  
                        // var element = document.createElement("div");
                        // element.appendChild(document.createTextNode(data[0].ISBN));
                        // element.appendChild(document.createTextNode(data[0].titulo));
                        
                        var template = document.getElementById('data').innerHTML;
                        // document.getElementById('data').innerHTML = "";
                        console.log(template); // Successful grabbing the HTML.
                        
                        // var div = document.getElementById('data');
                        // div.innerHTML = "";
                        // div.innerHTML += data[0].titulo;

                        var objTo         = document.getElementById('data');
                        var divtest       = document.createElement("div");
                        divtest.innerHTML = "new div";
                        objTo.appendChild(divtest);

                        // data.forEach((item) => {
                        // div.innerHTML += `
                        //             <li>${data[0].titulo}</li>
                        //         `;
                        // });

                        // document.getElementById('data').appendChild(document.createTextNode(data[0].titulo));
                        // addToDiv(data);
                    },
                    error:function(request, status, error) {
                        console.log("ajax call went wrong:" + request.responseText);
                    }
            });
        }

    </script>
    
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
