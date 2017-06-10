<script src="../dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nombre=$_POST["nombre"];
$correo=$_POST["email"];
$usuario=$_POST["usuario"];
$password=$_POST["pass"];
$direccion=$_POST["direccion"];
$empresa=$_POST["empresa"];
$telefono=$_POST["tel"];
$sexo=$_POST["sexo"];

require("./conexion.php");
   $conexion=  mysqli_connect("localhost","root","","crumart");
   
  if(mysqli_connect_errno()){
      echo "Error al conectar a la base de datos";
      exit();
  }
  mysqli_set_charset($conexion,"utf8");
  $consulta="insert into CLIENTE(id,nombre_c,correo_c,usuario_c,contrasenia_c,direccion_c,empresa_c,telefono_c,sexo_c,fecha_registro)"
          . " VALUES(null,'$nombre','$correo','$usuario','$password','$direccion'"
          . ",'$empresa','$telefono','$sexo',now())";
  $resultado=  mysqli_query($conexion, $consulta);
  
  
   if($resultado==FALSE){
     echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  title: "ERROR",
  text: "!Error, intenta luego¡",
  type: "error",
  showCancelButton: false,
  confirmButtonColor: "#00CCCC",
  confirmButtonText: "OK",
  closeOnConfirm: false
},
function(){
  window.location.href="../index.html";
});';
  echo '}, 0);</script>';
   
  }else{
       

    echo '<script type="text/javascript">';
  echo 'setTimeout(function () { swal({
  title: "Info",
  text: "!Registro exitoso¡",
  type: "info",
  showCancelButton: false,
  confirmButtonColor: "#00CCCC",
  confirmButtonText: "OK",
  closeOnConfirm: false
},
function(){
  window.location.href="../index.html";
});';
  echo '}, 0);</script>';
 
  }
  mysqli_close($conexion);
  
  ?>