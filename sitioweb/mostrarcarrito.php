<?php   
    include("templete/cabecera.php");
    include("administrador/config/bd.php");
    include("config.php");
    include("carrito.php");
?>

<br>
<h3>Lista del carrito</h3>

<?php if(!empty($_SESSION['carrito'])){?>
<table class="table table-light">
    <tbody>
        <tr>
            <th width="20%">Nombre</th>
            <th width="15%">Autor</th>
            <th width="15%">Editorial</th>
            <th width="20%">Género</th>
            <th width="10%">Idioma</th>
            <th width="10%">Precio</th>
        </tr>

        <?php $total=0;?>

        <tr>
            <th width="20%">Heartstopper</th>
            <th width="15%">Alice Oseman</th>
            <th width="15%">VRYA</th>
            <th width="20%">Novela Gráfica</th>
            <th width="10%">Español</th>
            <th width="10%">295</th>
            
        </tr>
        <tr>
            <th width="20%">Heaven Officials Blessing</th>
            <th width="15%">Mo Xiang Tong Xiu</th>
            <th width="15%">Seven Seas Entertainment</th>
            <th width="20%">Fantasia Historica</th>
            <th width="10%">Inglés</th>
            <th width="10%">550</th>
            
        </tr>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format(845,2)?></h3></td>
            <td></td>
        </tr>
    </tbody>
</table>
<?php }else{?>
    <div class="alert alert-success">
        No hay productos en el carrito...
    </div>

<?php }?>

<?php include("templete/pie.php"); ?>