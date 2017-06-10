<?php

   $conexion=  mysqli_connect("localhost","root","","crumart");
   
  if(mysqli_connect_errno()){
      echo "Error al conectar a la base de datos";
      exit();
  }
  mysqli_set_charset($conexion,"utf8");

  
     
?>