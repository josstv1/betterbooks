<?php   
    include("templete/cabecera.php");
    include("administrador/config/bd.php");
    include("config.php");
    include("carrito.php");
?>
    <br>
<div class="row">
<?php 
    $sentenciaSQL=$conexion -> prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listalibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    //print_r($listalibros);
?>

<?php foreach($listalibros as $libro) { ?>
    <div class="col-md-3">
        <br>
        <div class="card">
            <img alt="" class="card-img-top" src="./img/<?php echo $libro['imagen'];?>" 
            data-toggle="popover"
            data-trigger="hover"
            data-content="<?php echo $libro['autor'];?>"
            height="400px"
            >
            <div class="card-body">
                <h4 class="card-title"><?php echo $libro['nombre']; ?></h4>
                <p class="card-text">Autor: <?php echo $libro['autor']; ?></p>
                <p class="card-text">Editorial: <?php echo $libro['editorial']; ?></p>
                <p class="card-text">Género: <?php echo $libro['genero']; ?></p>
                <p class="card-text">Idioma: <?php echo $libro['idioma']; ?></p>
                <p class="card-text">$<?php echo $libro['precio']; ?></p>
                <form action="" method="post">
                <input type="hidden" name="nombre" value="<?php echo base64_encode(openssl_encrypt($libro['nombre'], COD, KEY)); ?>">
                    <input type="hidden" name="autor" value="<?php echo base64_encode(openssl_encrypt($libro['autor'], COD, KEY)); ?>">
                    <input type="hidden" name="editorial" value="<?php echo base64_encode(openssl_encrypt($libro['editorial'], COD, KEY)); ?>">
                    <input type="hidden" name="genero" value="<?php echo base64_encode(openssl_encrypt($libro['genero'], COD, KEY)); ?>">
                    <input type="hidden" name="idioma" value="<?php echo base64_encode(openssl_encrypt($libro['idioma'], COD, KEY)); ?>">
                    <input type="hidden" name="precio" value="<?php echo base64_encode(openssl_encrypt($libro['precio'], COD, KEY)); ?>">
                    <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">Añadir al carrito</button> 
                
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $(function(){
        $('[data-toggle="popover"]').popover()
    });
</script> 
<?php include("templete/pie.php"); ?>
