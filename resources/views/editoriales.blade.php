<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <title>Editoriales</title>
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
        <h1 class="display-4 text-center">Editoriales</h1>
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">

                    <!-- <form method="GET" action="{{ route('getAutores') }}"> -->
                        <div class="input-group mt-5 mb-5">
                            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" 
                                name="editorial_search" id="editorial_search" value="{{ old('editorial_search') }}"/>
                            <button type="button" class="btn btn-outline-primary" onclick="search()">search</button>
                        </div>
                    <!-- </form> -->

                    @if($editoriales->count() > 0)
                        <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>                        
                                <th scope="col">Editorial</th>  
                                <th scope="col">Acciones</th>                                            
                            </tr>   
                        </thead>
                        <tbody>
                            @foreach($editoriales as $editorial)
                            <tr>
                                <th scope="row" style="width: 6%">{{ $editorial->id }}</th>
                                <td style="width: 55%">{{ $editorial->editorial }}</td>                        
                                <td style="width: 1%">
                                    <form action="/editoriales/{{$editorial->id}}/edit" method="get"><button class="btn btn-outline-warning"
                                            type="submit">Editar</button>
                                    </form>
                                </td>
                                <td style="width: 1%">
                                    <form action="/editoriales/{{$editorial->id}}/edit" method="post">@method('DELETE')<button
                                            class="btn btn-outline-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        {{Session::flash('message','No tienes `Editoriales` registradas!!!');}}
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
        $('#editorial_search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : "{{URL::to('getEditoriales')}}",
                data: {'data_search':$value, 'table':'editoriales', 'field':'editorial'},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        });

        function search(){
            $value = $('#editorial_search').val();
            $.ajax({
                type : 'get',
                url : "{{URL::to('getEditoriales')}}",
                data: {'data_search':$value, 'table':'editoriales', 'field':'editorial'},
                    success:function(data){
                        $('tbody').html(data);
                    }
            });
        }

    </script>
    
    <!-- <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
