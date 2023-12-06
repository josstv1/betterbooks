<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITO WEB</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css"/><!--Vincula archivos css-->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#"> BETTERBOKS</a>    
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./administrador/index.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="productos.php">Libros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nosotros.php">Acerca de nosotros</a>
            </li>
        </ul>
    </nav>

    <script> src="./js/bootstrap.min.css" </script>
    <script src="https://kit.fontawesome.com/2621b525ec.js" crossorigin="anonymous"></script>

    <div class="container">
        <br/>
        <div class="row"> 

<div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="card card-warning text-center">
                        <h3>Formulario de registro</h3>
                    </div>
                    <form action="regirstro.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
                                    <div class="form-group">
                                        <label for="idclientes">Nombre de Usuario</label>
                                        <input type="text" class="form-control" name="idclientes" id="idclientes" placeholder="Ingrese su nombre de usuario" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nombre">Nombres</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese sus nombres" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="a_paterno">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="a_paterno" id="a_paterno" placeholder="Ingrese su apellido paterno" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="a_materno">Apellido Paterno</label>
                                        <input type="text" class="form-control" name="a_materno" id="a_materno" placeholder="Ingrese su apellido materno" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese su dirección" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="correo">Correo</label>
                                        <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="telefono">Telefono</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese su telefono" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="contrasena">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña minimo 8 y maximo 8" required>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <hr>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-danger btn lg">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>
</html>