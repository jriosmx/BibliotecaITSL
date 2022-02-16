<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="mx-auto col-6 offset-3 mt-4">

           @if(Session::has('message'))
                <div class="alert alert-danger alert-dismissible alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="location.href='/login';"><span aria-hidden="true">&times;</span></button>
                    {{Session::get('message')}}
                </div>
            @endif

        </div>
    </div>

    <div class="container">
        <div class="mx-auto col-6">
            <!--Dentro de la sintaxis puede ir cualquier expresión de php -->
            <h1 class="display-4 mt-3 text-center">Inicia Sesión</h1>
            <form action="/login" method="post" class="needs-validation">
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
                                name="password" value="{{old('password', '')}}">
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @endError
                        </div>
                    </div>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="recordarSesion">
                    <label class="form-check-label" for="recordarSesion">Recuérdame</label>
                </div>

                <div class="container-button h-100"> 
    		        <div class="row w-100 align-items-center">
    			        <div class="col text-center">
                            <button class="btn btn-primary display: flex; justify-content: center;" type="submit">Enviar</button>
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
