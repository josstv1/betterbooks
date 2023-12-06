<?php include("../templete/cabecera.php"); ?>
<?php 

    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtAutor=(isset($_POST['txtAutor']))?$_POST['txtAutor']:"";
    $txtEditorial=(isset($_POST['txtEditorial']))?$_POST['txtEditorial']:"";
    $txtGenero=(isset($_POST['txtGenero']))?$_POST['txtGenero']:"";
    $txtIdioma=(isset($_POST['txtIdioma']))?$_POST['txtIdioma']:"";
    $txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    $accion=(isset($_POST['accion']))?$_POST['accion']:"";

    include("../config/bd.php");

    switch($accion){

        case"Agregar":
            //INSERT INTO `libros` (`ID`, `Nombre`, `Imagen`) VALUES (NULL, 'Libro de php', 'imagen.jpg');
            $sentenciaSQL=$conexion -> prepare("INSERT INTO libros (id_libros,nombre,autor,editorial,genero,idioma,precio,imagen) VALUES (:id_libros, :nombre, :autor, :editorial, :genero, :idioma, :precio, :imagen);");
            $sentenciaSQL-> bindParam(':id_libros',$txtID);
            $sentenciaSQL -> bindParam(':nombre',$txtNombre);
            $sentenciaSQL -> bindParam(':autor',$txtAutor);
            $sentenciaSQL -> bindParam(':editorial',$txtEditorial);
            $sentenciaSQL -> bindParam(':genero',$txtGenero);
            $sentenciaSQL -> bindParam(':idioma',$txtIdioma);
            $sentenciaSQL -> bindParam(':precio',$txtPrecio);

            $fecha=new DateTime();
            $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";

            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];
            if($tmpImagen!=""){
                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
            }
            $sentenciaSQL -> bindParam('imagen',$nombreArchivo);
            $sentenciaSQL -> execute();
            header("Location:productos.php");
            break;

        case"Modificar":
            //echo "Presionado boton Modificar";
            $sentenciaSQL=$conexion -> prepare("UPDATE libros SET nombre=:nombre, autor=:autor, editorial=:editorial, genero=:genero, idioma=:idioma, precio=:precio WHERE id_libros=:id_libros");
            $sentenciaSQL->bindParam(':id_libros',$txtID);
            $sentenciaSQL -> bindParam(':nombre',$txtNombre);
            $sentenciaSQL -> bindParam(':autor',$txtAutor);
            $sentenciaSQL -> bindParam(':editorial',$txtEditorial);
            $sentenciaSQL -> bindParam(':genero',$txtGenero);
            $sentenciaSQL -> bindParam(':idioma',$txtIdioma);
            $sentenciaSQL -> bindParam(':precio',$txtPrecio);
            
            $sentenciaSQL->execute();
            if($txtImagen!=""){//Validamos que haya una imagen
                $fecha=new DateTime();
                $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";//Renombramos
                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];  

                move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);//Movemos/copiado el archivo a la carpeta img
                
                $sentenciaSQL=$conexion -> prepare("SELECT imagen FROM libros WHERE id_libros=:id_libros");//Esto es para borrar la foto antigua
                $sentenciaSQL->bindParam(':id_libros',$txtID);
                $sentenciaSQL->execute();     
                $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
                
                if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg") ){
                    if(file_exists("../../img/".$libro["imagen"])){//Busca si existe la imagen en la carpeta img
                        unlink("../../img/".$libro["imagen"]);//Si es así la borra
                    }
                }

                $sentenciaSQL=$conexion -> prepare("UPDATE libros SET imagen=:imagen WHERE id_libros=:id_libros");//Se actualiza con la imagen nueva
                $sentenciaSQL -> bindParam(':imagen',$nombreArchivo);
                $sentenciaSQL->bindParam(':id_libros',$txtID);
                $sentenciaSQL->execute();
            }
            header("Location:productos.php");
            
            break;
        case"Cancelar":
            //echo "Presionado boton Cancelar";
            header("Location:productos.php");
            break;
        case"Seleccionar":
            $sentenciaSQL=$conexion -> prepare("SELECT * FROM libros WHERE id_libros=:id_libros");//Seleciona de la bd lirbos los ID
            $sentenciaSQL->bindParam(':id_libros',$txtID);
            $sentenciaSQL->execute();
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

            $txtNombre=$libro['nombre'];//Asigna los valores recuperados de la bd
            $txtAutor=$libro['autor'];//Asigna los valores recuperados de la bd
            $txtEditorial=$libro['editorial'];//Asigna los valores recuperados de la bd
            $txtGenero=$libro['genero'];//Asigna los valores recuperados de la bd
            $txtIdioma=$libro['idioma'];//Asigna los valores recuperados de la bd
            $txtPrecio=$libro['precio'];//Asigna los valores recuperados de la bd
            $txtImagen=$libro['imagen'];//Asigna los valores recuperados de la bd
            break;
        case"Borrar":
            $sentenciaSQL=$conexion -> prepare("SELECT imagen FROM libros WHERE id_libros=:id_libros");
            $sentenciaSQL->bindParam(':id_libros',$txtID);
            $sentenciaSQL->execute();     
            $libro=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            
            if(isset($libro["imagen"]) && ($libro["imagen"]!="imagen.jpg") ){
                if(file_exists("../../img/".$libro["imagen"])){//Busca si existe la imagen en la carpeta img
                    unlink("../../img/".$libro["imagen"]);//Si es así la borra
                }
            }
            $sentenciaSQL=$conexion -> prepare("DELETE FROM libros WHERE id_libros=:id_libros");
            $sentenciaSQL->bindParam(':id_libros',$txtID);
            $sentenciaSQL->execute(); 
            header("Location:productos.php");     
            break;
    }
    $sentenciaSQL=$conexion -> prepare("SELECT * FROM libros");
    $sentenciaSQL->execute();
    $listalibros=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                Datos del libro
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class = "form-group">
                        <label for="txtID">ID</label>
                        <input type="text" required class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                    </div>

                    <div class = "form-group">
                        <label for="txtNombre">Nombre:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtAutor">Autor:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtAutor; ?>" name="txtAutor" id="txtAutor" placeholder="Autor del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtEditorial">Editorial:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtEditorial; ?>" name="txtEditorial" id="txtEditorial" placeholder="Editorial del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtGenero">Genero:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtGenero; ?>" name="txtGenero" id="txtGenero" placeholder="Genero del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtIdioma">Idioma:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtIdioma; ?>" name="txtIdioma" id="txtIdioma" placeholder="Idioma del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtPrecio">Precio:</label>
                        <input type="text" required class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="Precio del libro">
                    </div>

                    <div class = "form-group">
                        <label for="txtImagen">Imagen:</label><br/>
                        <?php 
                            if($txtImagen!=""){?>
                                <img class="img-thumbbnail rounded" src="../../img/<?php echo $txtImagen;?>" width="100" alt="" srcset=""> 

                        <?php } ?>
                        <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen del libro">
                    </div>

                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" name="accion" <?php echo($accion=="Seleccionar")?"disabled":"";?> value="Agregar" class="btn btn-success">Agregar</button>
                        <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Modificar" class="btn btn-warning">Modificar</button>
                        <button type="submit" name="accion" <?php echo($accion!="Seleccionar")?"disabled":"";?> value="Cancelar" class="btn btn-info">Cancelar</button>  
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="col-xl-8">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>Genero</th>
                    <th>Idioma</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($listalibros as $libro) { ?>
                <tr>
                    <td ><?php echo $libro['id_libros'];?></td>
                    <td><?php echo $libro['nombre'];?></td>
                    <td><?php echo $libro['autor'];?></td>
                    <td><?php echo $libro['editorial'];?></td>
                    <td><?php echo $libro['genero'];?></td>
                    <td><?php echo $libro['idioma'];?></td>
                    <td ><?php echo $libro['precio'];?></td>
                    <td>
                        <img src="../../img/<?php echo $libro['imagen'];?>" width="100" alt="" srcset="">
                        
                    </td>
                    
                    <td>
                        <form method="post">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id_libros'];?>">
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