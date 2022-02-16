<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
    <title>Biblioteca TecNM</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @if(Auth::user())
                <ul class="navbar-nav me-auto">            
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Autor
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/autores/create">Nuevo Autor</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/autores">Ver Autores</a>
                        </div>
                    </li>            
                </ul>

                <ul class="navbar-nav me-auto">            
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/categorias/create">Nueva Categoría</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/categorias">Ver Categorías</a>
                        </div>
                    </li>            
                </ul>

                <ul class="navbar-nav me-auto">            
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Editoriales
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/editoriales/create">Nueva Editorial</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/editoriales">Ver Editoriales</a>
                        </div>
                    </li>            
                </ul>

                <ul class="navbar-nav me-auto">            
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Libros
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/libros/create">Nuevo Libro</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/libros">Ver Libros</a>
                        </div>
                    </li>            
                </ul>
            @endif
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                @if(!Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/users/create">Regístrate</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="/login">Iniciar sesión</a>
                    </li>
                @else
                    <ul class="navbar-nav me-auto">            
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->nombre}} {{Auth::user()->apellidos}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/users/{{Auth::user()->id}}/edit">Editar Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">Cerrar sesión</a>
                            </div>
                        </li>            
                    </ul>                    
                @endif        
            </ul>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="display-2 text-center">
            @auth 
                Bienvenid@ {{Auth::user()->username}}
            @endAuth
            @guest
                Bienvenidos al TecNM Campus Loreto
            @endGuest
            
        </h1>
        <br><br>
        <h3><p class="display-6 text-center">Sistema para la Biblioteca del TecNM campus Loreto</p></h3>
    </div>


   
               
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>
