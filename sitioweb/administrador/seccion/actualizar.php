<?php include("../templete/cabeceraemp.php"); ?>
<?php 
    $txtID_Empleado=(isset($_POST['txtID_Empleado']))?$_POST['txtID_Empleado']:"";
    $txtID_Libros=(isset($_POST['txtID_Libros']))?$_POST['txtID_Libros']:"";
    $txtCantidad=(isset($_POST['txtCantidad']))?$_POST['txtCantidad']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include("../config/bd.php");

    switch($accion){

        case"Modificar":
            //echo "Presionado boton Modificar";
            $sentenciaSQL=$conexion -> prepare("UPDATE actualizar SET id_libros=:id_libros, cantidad=:cantidad WHERE id_libros=:id_libros");
            //$sentenciaSQL->bindParam(':idempleado',$txtID_Empleado);
            $sentenciaSQL->bindParam(':id_libros',$txtID_Libros);
            $sentenciaSQL ->bindParam(':cantidad',$txtCantidad);
            $sentenciaSQL->execute();
            
            $actualizar=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            header("Location:actualizar.php");
            break;
        case"Cancelar":
            //echo "Presionado boton Cancelar";
            header("Location:actualizar.php");
            break;
        case"Seleccionar":
            $sentenciaSQL=$conexion -> prepare("SELECT * FROM actualizar WHERE idempleado=:idempleado");//Seleciona de la bd lirbos los ID
            $sentenciaSQL->bindParam(':idempleado',$txtID_Empleado);
            $sentenciaSQL->execute();
            $actualizar=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            //$actualizar = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

            //$txtID_Empleado=$actualizar['idempleado'];//Asigna los valores recuperados de la bd
            $txtID_Libros=$actualizar['id_libros'];//Asigna los valores recuperados de la bd
            $txtCantidad=$actualizar['cantidad'];//Asigna los valores recuperados de la bd
            break;
        case"Borrar":
            $sentenciaSQL=$conexion -> prepare("DELETE FROM actualizar WHERE idempleado=:idempleado");
            $sentenciaSQL->bindParam(':idempleado',$txtID_Empleado);
            $sentenciaSQL->execute(); 

            $actualizar=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            header("Location:actualizar.php");     
            break;
    }
    $sentenciaSQL=$conexion -> prepare("SELECT * FROM actualizar");
    $sentenciaSQL->execute();
    $lista_actualizar=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Datos del libro
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtID_Empleado">ID Empleado</label>
                        <input type="text" required readonly class="form-control" value="<?php echo $txtID_Empleado; ?>" name="txtID_Empleado" id="txtID_Empleado" placeholder="ID del Empleado">
                    </div>

                    <div class = "form-group">
                        <label for="txtID_Libros">ID Libros</label>
                        <input type="text" required readonly class="form-control" value="<?php echo $txtID_Libros; ?>" name="txtID_Libros" id="txtID_Libros" placeholder="ID del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtCantidad">Cantidad:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtCantidad; ?>" name="txtCantidad" id="txtCantidad" placeholder="Cantidad de libros">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>  
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Empleado</th>
                    <th>ID Libro</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($lista_actualizar as $actualizar) { ?>
                <tr>
                    <td ><?php echo $actualizar['idempleado'];?></td>
                    <td ><?php echo $actualizar['id_libros'];?></td>
                    <td><?php echo $actualizar['cantidad'];?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID_Empleado" id="txtID_Empleado" value="<?php echo $actualizar['idempleado'];?>">
                            <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                            <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                        </form>
                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

<?php include("../templete/pie.php"); ?>