<?php
    $idclientes = $_POST['idclientes'] ? $_POST['idclientes'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $a_paterno = isset($_POST['a_paterno']) ? $_POST['a_paterno'] : '';
    $a_materno = isset($_POST['a_materno']) ? $_POST['a_materno'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $correo = isset($_POST['correo']) ? $_POST['correo'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : '';

    include("./administrador/config/bd.php");

    //Seleccionamos de la base de datos
    $sentenciaSQL=$conexion -> prepare("INSERT INTO clientes (idclientes,nombre,a_paterno,a_materno,direccion,correo,telefono,contrasena) VALUES (:idclientes, :nombre, :a_paterno, :a_materno, :direccion, :correo, :telefono, :contrasena);");
    $sentenciaSQL-> bindParam(':idclientes',$idclientes);
    $sentenciaSQL-> bindParam(':nombre',$nombre);
    $sentenciaSQL -> bindParam(':a_paterno',$a_paterno);
    $sentenciaSQL -> bindParam(':a_materno',$a_materno);
    $sentenciaSQL -> bindParam(':direccion',$direccion);
    $sentenciaSQL -> bindParam(':correo',$correo);
    $sentenciaSQL -> bindParam(':telefono',$telefono);
    $sentenciaSQL -> bindParam(':contrasena',$contrasena);
    $sentenciaSQL -> execute();

    header("location:index.php");
?>