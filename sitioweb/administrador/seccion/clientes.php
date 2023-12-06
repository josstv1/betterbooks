<?php include("../templete/cabecera.php"); ?>
<?php
    $txtID_Clientes=(isset($_POST['txtID_Clientes']))?$_POST['txtID_Clientes']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtA_paterno=(isset($_POST['txtA_paterno']))?$_POST['txtA_paterno']:"";
    $txtA_materno=(isset($_POST['txtA_materno']))?$_POST['txtA_materno']:"";
    $txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
    $txtContraseña = isset($_POST['txtContraseña']) ? $_POST['txtContraseña'] : '';

    include("../config/bd.php");

    $sentenciaSQL=$conexion -> prepare("SELECT * FROM clientes");
    $sentenciaSQL->execute();
    $lista_clientes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>    

<div class="col">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Clientes</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Dirección</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Contraseña</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($lista_clientes as $clientes) { ?>
                <tr>
                    <td ><?php echo $clientes['idclientes'];?></td>
                    <td ><?php echo $clientes['nombre'];?></td>
                    <td ><?php echo $clientes['a_paterno'];?></td>
                    <td ><?php echo $clientes['a_materno'];?></td>
                    <td ><?php echo $clientes['direccion'];?></td>
                    <td ><?php echo $clientes['correo'];?></td>
                    <td ><?php echo $clientes['telefono'];?></td>
                    <td ><?php echo $clientes['contrasena'];?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php include("../templete/pie.php"); ?>