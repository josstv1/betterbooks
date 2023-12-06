


<?php include('cabecera.php');?>
<?php
    //Obtenemos info de la pag
    $txtID_libro = isset($_POST['idlibro']) ? $_POST['idlibro'] : '';
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : '';

    include("../config/bd.php");
    //Verificamos que se encuentre en el carrito
    $sentenciaSQL=$conexion -> prepare("SELECT * FROM carrito WHERE librosid=:librosid");//Esto es para borrar la foto antigua
    $sentenciaSQL->bindParam(':librosid',$txtID_libro);
    $sentenciaSQL->execute();     
    $producto=$sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    if ($producto) {
        // El producto ya existe en el carrito, actualizar la cantidad
        $cantidad += $producto['cantidad'];
        $sentenciaSQL = $conexion->prepare("UPDATE carrito SET cantidad=:cantidad WHERE librosid=:librosid");
        $sentenciaSQL->bindParam(':librosid',$txtID_libro);
        $sentenciaSQL->bindParam(':cantidad',$cantidad);
        $sentenciaSQL->execute();
        //$sentenciaSQL->execute(['cantidad' => $cantidad, 'librosid' => $txtID_libro]);
    } else {
        // El producto no existe en el carrito, insertar nuevo registro
        $sentenciaSQL = $conexion->prepare("INSERT INTO carrito (librosid, cantidad) VALUES (:librosid, :cantidad)");
        $sentenciaSQL->bindParam(':librosid',$txtID_libro);
        $sentenciaSQL->bindParam(':cantidad',$cantidad);
        //$sentenciaSQL->execute(['librosid' => $txtID_libro, 'cantidad' => $cantidad]);
    }
    // Redireccionar a la página del carrito de compras
    //header('Location:carrito.php');
    
?>

<?php include('pie.php');?> 