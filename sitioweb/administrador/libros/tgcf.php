<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITO WEB</title>

    <link rel="stylesheet" href="../../css/bootstrap.css"/><!--Vincula archivos css-->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#"> BETTERBOKS</a>    
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../../productos.php">Regresar</a>
        </ul>
    </nav>

    <?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtAutor=(isset($_POST['txtAutor']))?$_POST['txtAutor']:"";
$txtEditorial=(isset($_POST['txtEditorial']))?$_POST['txtEditorial']:"";
$txtGenero=(isset($_POST['txtGenero']))?$_POST['txtGenero']:"";
$txtIdioma=(isset($_POST['txtIdioma']))?$_POST['txtIdioma']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";

include("../config/bd.php");

$sentenciaSQL=$conexion -> prepare("SELECT * FROM libros");
$sentenciaSQL->execute();
$listalibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
    <div class="container">
        <br/>
        <div class="row"> 
            <div class="jumbotron text-center">
                <h1 class="display-3">--Heaven Official's Blessing--</h1>
                <p class="lead">Descubre nuevas historias a tan solo un click</p>
                <hr class="my-2">
                <img width="500" src="./img/<?php echo $libro['imagen'];?>" class="img-thumbnail rounded mx-auto d-block"/>
                <p>Más información</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="productos.php" role="button">Ver libros</a>
                </p>
            </div>
            </div>
    </div>
</body>
</html>