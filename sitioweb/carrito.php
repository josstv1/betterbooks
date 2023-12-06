<?php
session_start();
$mensaje="";
$nombre="";
$autor="";
$editorial="";
$genero="";
$idioma="";
$precio="";
    if(isset($_POST['btnAccion'])){
        switch($_POST['btnAccion']){
            case 'Agregar':
                $nombre = base64_decode(openssl_decrypt($_POST['nombre'], COD, KEY));
                $autor = base64_decode(openssl_decrypt($_POST['autor'], COD, KEY));
                $editorial = base64_decode(openssl_decrypt($_POST['editorial'], COD, KEY));
                $genero = base64_decode(openssl_decrypt($_POST['genero'], COD, KEY));
                $idioma = base64_decode(openssl_decrypt($_POST['idioma'], COD, KEY));
                $precio = base64_decode(openssl_decrypt($_POST['precio'], COD, KEY));

                $mensaje .= "Ok, nombre completo: " . $nombre . "<br>";
                $mensaje .= "Ok, autor completo: " . $autor . "<br>";
                $mensaje .= "Ok, editorial completo: " . $editorial . "<br>";
                $mensaje .= "Ok, genero completo: " . $genero . "<br>";
                $mensaje .= "Ok, idioma completo: " . $idioma . "<br>";
                $mensaje .= "Ok, precio completo: " . $precio . "<br>";

                if(!isset($_SESSION['carrito'])){
                    $producto=array(
                        'nombre'=>$nombre,
                        'autor'=>$autor,
                        'editorial'=>$editorial,
                        'genero'=>$genero,
                        'idioma'=>$idioma,
                        'precio'=>$precio
                    );
                    $_SESSION['carrito'][0]=$producto;
                }else{
                    $NumProductos=count($_SESSION['carrito']);
                    $producto=array(
                        'nombre'=>$nombre,
                        'autor'=>$autor,
                        'editorial'=>$editorial,
                        'genero'=>$genero,
                        'idioma'=>$idioma,
                        'precio'=>$precio
                    );
                    $_SESSION['carrito'][$NumProductos]=$producto;
                }

            break;
        }
    }

?>