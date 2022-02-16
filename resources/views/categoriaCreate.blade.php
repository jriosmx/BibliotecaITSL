<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$titulo}}</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            @if($titulo == 'Nueva Categoría')
                <a class="navbar-brand" href="{{ url('/') }}">&nbsp;&nbsp;< Volver </a>
            @else
                <a class="navbar-brand" href="{{ url('/categorias') }}">&nbsp;&nbsp;< Volver </a>
            @endif
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    </nav>

    <div class="container">
        
    </div>
    <div class="container">
        <div class="mx-auto col-6">
            <h1 class="display-4 mt-3 text-center">{{$titulo}}</h1> 
            @if($titulo == 'Nueva Categoría')
                <form action="/categorias" method="post" class="needs-validation">
            @else
                <form action="/categorias/{{$categoria->id}}" method="post" class="needs-validation">
                @method('PUT')
            @endif
            
                
                <div class="row mt-5 mb-5" >
                    <div class="col">
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoria</label>
                            <input type="text" class="form-control @error('categoria') is-invalid @endError" id="categoria"
                                name="categoria" value="{{old('categoria', $categoria->categoria ?? '')}}">
                            @error('categoria')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>     
                
                <div class="mx-auto col-6 offset-3 mt-4">

                    @if(Session::has('message'))
                        @if($titulo == 'Nueva Categoría')
                            <div class="alert alert-success alert-dismissible alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/';"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('message')}}
                            </div>
                        @else
                            <div class="alert alert-success alert-dismissible alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/categorias';"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('message')}}
                            </div>
                        @endif
                    @endif

                </div>

                <div class="container-button h-100" > 
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>

</html>
