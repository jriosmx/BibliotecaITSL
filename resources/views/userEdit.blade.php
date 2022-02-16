<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand" href="/">&nbsp;&nbsp;< Volver </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    </nav>    

    <div class="container">
        <div class="mx-auto col-6">
            <!--Dentro de la sintaxis puede ir cualquier expresión de php -->
            <h1 class="display-4 mt-3 text-center">Editar Usuario</h1> 
            <form action="/users/{{$user->id}}" method="post" class="needs-validation">
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @endError" id="nombre"
                                name="nombre" value="{{old('nombre', $user->nombre ?? '')}}">
                            @error('nombre')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <input type="text" class="form-control @error('apellidos') is-invalid @endError" id="apellidos"
                                name="apellidos" value="{{old('apellidos', $user->apellidos ?? '')}}">
                            @error('apellidos')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control @error('username') is-invalid @endError" id="username"
                                name="username" value="{{old('username', $user->username ?? '')}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @endError" id="email"
                                name="email" value="{{old('email', $user->email ?? '')}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @endError" id="password"
                                name="password" value="{{old('password', $user->password)}}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>    
                
                <div class="container">
                    <div class="mx-auto col-7 offset-3 mt-4">

                    @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible alert-block" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/';"><span aria-hidden="true">&times;</span></button>
                                {{Session::get('message')}}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="container-button h-100"> 
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
