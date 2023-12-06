<?php 
    //$dsn = 'mysql:host=localhost;port=3307;dbname=betterbooks';
    //$hostname ="localhost"; 
    //$username="root";
    //$pass="jocelyn01";
    //$database="betterbooks";
    //$port="3307";

    $dsn = 'mysql:host=localhost;port=3306;dbname=betterbooks';
    $hostname = 'localhost';
    $username = 'root';
    $pass = '';
    $database = 'betterbooks';

    
    try{
        $conexion = new PDO($dsn, $username, $pass);
        //if($conexion){echo "Connected successfully";}
    }catch(Exception $ex){
        echo $ex->getMessage();
    }

    //$conexion = mysqli_connect($hostname, $username, $pass, $database, $port);
    //mysqli_select_db($conectar, $database);
    //return $conectar;
    // Check connection
    //if (!$conexion) {
      //  die("Connection failed: " . mysqli_connect_error());
    //}
    //echo "Connected successfully";
    //mysqli_close($conectar);
?>

