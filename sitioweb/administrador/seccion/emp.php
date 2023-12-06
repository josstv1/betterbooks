<?php include("../templete/cabecera.php"); ?>
<?php
    $txtID_Empleado=(isset($_POST['txtID_Empleado']))?$_POST['txtID_Empleado']:"";
    $txtCargo=(isset($_POST['txtCargo']))?$_POST['txtCargo']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtA_paterno=(isset($_POST['txtA_paterno']))?$_POST['txtA_paterno']:"";
    $txtA_materno=(isset($_POST['txtA_materno']))?$_POST['txtA_materno']:"";
    $txtTelefono=(isset($_POST['txtTelefono']))?$_POST['txtTelefono']:"";
    $txtSueldo=(isset($_POST['txtSueldo']))?$_POST['txtSueldo']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include("../config/bd.php");

    switch($accion){

        case"Modificar":
            //echo "Presionado boton Modificar";
            $sentenciaSQL=$conexion -> prepare("UPDATE empleado SET cargo=:cargo, nombre=:nombre, a_paterno=:a_paterno, a_materno=:a_materno, telefono=:telefono, sueldo=:sueldo WHERE idempleado=:idempleado");
            $sentenciaSQL->bindParam(':idempleado',$txtID_Empleado);
            $sentenciaSQL->bindParam(':cargo',$txtCargo);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':a_paterno',$txtA_paterno);
            $sentenciaSQL->bindParam(':a_materno',$txtA_materno);
            $sentenciaSQL ->bindParam(':telefono',$txtTelefono);
            $sentenciaSQL ->bindParam(':sueldo',$txtSueldo);
            $sentenciaSQL->execute();

            $empleado=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            header("Location:emp.php");
            break;
        case"Cancelar":
            //echo "Presionado boton Cancelar";
            header("Location:emp.php");
            break;
        case"Seleccionar":
            $sentenciaSQL=$conexion -> prepare("SELECT * FROM empleado WHERE idempleado=:idempleado");//Seleciona de la bd lirbos los ID
            $sentenciaSQL->bindParam(':idempleado',$txtID_Empleado);
            $sentenciaSQL->execute();
            $empleado=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            //$txtID_Empleado=$empleado['idempleado'];//Asigna los valores recuperados de la bd
            $txtCargo=$empleado['cargo'];//Asigna los valores recuperados de la bd
            $txtNombre=$empleado['nombre'];//Asigna los valores recuperados de la bd
            $txtA_paterno=$empleado['a_paterno'];//Asigna los valores recuperados de la bd
            $txtA_materno=$empleado['a_materno'];//Asigna los valores recuperados de la bd
            $txtTelefono=$empleado['telefono'];//Asigna los valores recuperados de la bd
            $txtSueldo=$empleado['sueldo'];//Asigna los valores recuperados de la bd
            break;
        case"Borrar":
            $sentenciaSQL=$conexion -> prepare("DELETE FROM empleado WHERE idempleado=:idempleado");
            $sentenciaSQL->bindParam(':idempleado',$txtID_Empleado);
            $sentenciaSQL->execute(); 

            $empleado=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            header("Location:emp.php");     
            break;
    }
    $sentenciaSQL=$conexion -> prepare("SELECT * FROM empleado");
    $sentenciaSQL->execute();
    $lista_empleado=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

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
                        <input type="text" required class="form-control" value="<?php echo $txtID_Empleado; ?>" name="txtID_Empleado" id="txtID_Empleado" placeholder="ID del Empleado">
                    </div>

                    <div class = "form-group">
                        <label for="txtCargo">Cargo</label>
                        <input type="text" required class="form-control" value="<?php echo $txtCargo; ?>" name="txtCargo" id="txtCargo" placeholder="Cargo">
                    </div>

                    <div class = "form-group">
                        <label for="txtNombre">Nombre</label>
                        <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                    </div>

                    <div class = "form-group">
                        <label for="txtA_paterno">Apellido Paterno</label>
                        <input type="text" required class="form-control" value="<?php echo $txtA_paterno; ?>" name="txtA_paterno" id="txtA_Paterno" placeholder="Apellido Paterno">
                    </div>

                    <div class = "form-group">
                        <label for="txtA_materno">Apellido Materno</label>
                        <input type="text" required class="form-control" value="<?php echo $txtA_materno; ?>" name="txtA_materno" id="txtA_materno" placeholder="Apellido Materno">
                    </div>

                    <div class = "form-group">
                        <label for="txtTelefono">Telefono:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtTelefono; ?>" name="txtTelefono" id="txtTelefono" placeholder="Telefono">
                    </div>
                    <div class = "form-group">
                        <label for="txtSueldo">Sueldo:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtSueldo; ?>" name="txtSueldo" id="txtSueldo" placeholder="Sueldo">
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
                    <th>Cargo</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Telefono</th>
                    <th>Sueldo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($lista_empleado as $empleado) { ?>
                <tr>
                    <td ><?php echo $empleado['idempleado'];?></td>
                    <td ><?php echo $empleado['cargo'];?></td>
                    <td ><?php echo $empleado['nombre'];?></td>
                    <td ><?php echo $empleado['a_paterno'];?></td>
                    <td ><?php echo $empleado['a_materno'];?></td>
                    <td ><?php echo $empleado['telefono'];?></td>
                    <td ><?php echo $empleado['sueldo'];?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID_Empleado" id="txtID_Empleado" value="<?php echo $empleado['idempleado'];?>">
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