<?php

$email_to = "i.quezada.10117@gmail.com";
$email_subject = "Reporte";


$formatos=array('.jpg','.png');



$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$empresa = $_POST["empresa"];
$direccion = $_POST["direccion"];
$tel = $_POST["telefono"];
$tipo = $_POST["tipo"];


/*cho $direccion ;
echo $tel ;
echo $tipo $nombreArchivo=$_FILES['imagen']['name'];
$nombreTmpArchivo=$_FILES['imagen']['tmp_name'];
$ext=substr($nombreArchivo,strrpos($nombreArchivo,'.'));
if(in_array($ext,$formatos)){
	$Uploadfile = $_SERVER['DOCUMENT_ROOT']'imagenReporte/$nombreTmpArchivo';
}

*/


require("./conexion.php");
   $conexion=  mysqli_connect("localhost","root","","crumart");
   
  if(mysqli_connect_errno()){
      echo "Error al conectar a la base de datos";
      exit();
  }
  mysqli_set_charset($conexion,"utf8");
  $consulta="insert into CITAS(id,nombre,correo,empresa,direccion"
          . ",telefono,tipo) VALUES('null','$nombre','$correo','$empresa','$direccion'"
          . ",'$tel','$tipo')";
  $resultado=  mysqli_query($conexion, $consulta);
 
  
$cabeceras = "From: " . strip_tags("solucionesveta") . "\r\n";
$cabeceras .= "Reply-To: ". strip_tags($email_to) . "\r\n";
$cabeceras .= "CC: jerff.hardy@hotmail.com\r\n";
$cabeceras .= "MIME-Version: 1.0\r\n";
$cabeceras .= "Content-Type: text/html; charset=iso-8859-1\r\n";


$mensaje = '<html><body>';
$mensaje .= '<img src="http://www.solucionesveta.com.mx/images/veta.png" alt="Space Invaders" />';
$mensaje .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$mensaje .= "<tr style='background: #eee;'><td><strong>Nombre:</strong> </td><td>" . strip_tags($nombre) . "</td></tr>";
$mensaje .= "<tr><td><strong>Correo:</strong> </td><td>" . strip_tags($correo) . "</td></tr>";
$mensaje .= "<tr><td><strong>Empresa:</strong> </td><td>" . strip_tags($empresa) . "</td></tr>";
$mensaje .= "<tr><td><strong>Direccion:</strong> </td><td>" . strip_tags($direccion) . "</td></tr>";
$mensaje .= "<tr><td><strong>Telefono:</strong> </td><td>" . strip_tags($tel) . "</td></tr>";
$mensaje .= "<tr><td><strong>Tipo de servicio:</strong> </td><td>" . strip_tags($tipo) . "</td></tr>";

                
$mensaje .= "</table>";
$mensaje .= "</body></html>";

    mail($email_to, $email_subject, $mensaje,$cabeceras);
    echo "mail($email_to, $email_subject, $mensaje,$cabeceras)";
  

  if($resultado==FALSE){
   echo "<script>alert('Error en la consulta')</script>";
   
  }else{
       
 
     echo "<script>alert('Reporte enviado correctamente'); </script>";
     
    
  }
  mysqli_close($conexion);
  
?>