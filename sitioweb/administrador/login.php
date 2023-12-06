<?php
    $idclientes = $_POST['idclientes'] ? $_POST['idclientes'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    include("../config/bd.php");

    //Seleccionamos de la base de datos
    $sentenciaSQL=$conexion -> prepare("SELECT * FROM clientes WHERE idclientes=:idclientes, contrasena=:contrasena");//Seleciona de la tabla "clientes" los usuarios y contraseñas
        $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

    header("location:../index.php");
?>
  