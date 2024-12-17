<?php
  $nombre = $_POST['nombre'];
  $password= $_POST['password'];
  $genero= $_POST['genero'];
  $email= $_POST['email'];
  $telefono= $_POST['telefono'];

   if( !empty($nombre) || !empty($password)||  !empty($genero)|| !empty($email) || !empty($telefono))
   {
    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="registro";

    $conn = new mysqli ($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error())
    {
      die('connect error ('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else 
    {
       $SELECT = "SELECT telefono from usuarios where telefono = ? limit 1";
       $INSERT ="INSERT INTO usuarios (nombre, password, genero ,email ,telefono)values(?,?,?,?,?)";

       $stmt = $conn->prepare($SELECT);
       $stmt ->bind_param("i", $telefono);
       $stmt ->execute();
       $stmt ->bind_result($telefono);
       $stmt ->store_result();
       $rnum = $stmt ->num_rows;

       if($rnum==0)
       {
           $stmt ->close();
           $stmt = $conn->prepare($INSERT);
           $stmt ->bind_param ("ssssi" ,$nombre, $password, $genero, $email, $telefono);
           $stmt ->execute();
           echo "REGISTRO COMPLETADO";
       }
           else
           {
             echo "alguien ya registro ese numero ";
           }

           $stmt ->close();
           $conn ->close();
    } 
      
    }  

     else
    {
    echo "todos los datos con OBLIGATORIOS";
    die();
    }
?>