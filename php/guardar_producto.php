<script src="../dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/sweetalert.css">
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$nombre=$_POST["nombre"];
$precio=$_POST["precio"];
$stock=$_POST["stock"];



require("./conexion.php");
   $conexion=  mysqli_connect("localhost","root","","login");
   
  if(mysqli_connect_errno()){
      echo "Error al conectar a la base de datos";
      exit();
  }
  mysqli_set_charset($conexion,"utf8");
  $consulta="insert into PRODUCTO(cod_producto,nom_producto,precio,stock)"
          . " VALUES('null','$nombre','$precio','$stock')";
        
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