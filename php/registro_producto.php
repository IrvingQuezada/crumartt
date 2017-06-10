<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
          <form class="formulario" action="guardar_producto.php" name="formulario_registro" method="POST" enctype="multipart/form-data">
                    <div>
                        <div class="input-group">
                            <input type="text" id="nombre" name="nombre">
                            <label class="label" for="nombre">Nombre</label>
                        </div>
                        <div class="input-group">
                            <input type="text" id="precio" name="precio">
                            <label class="label" for="email">Precio:</label>
                        </div>
                         <div class="input-group">
                            <input type="text" id="stock" name="stock">
                            <label class="label" for="stock">Stock:</label>
                        </div>
                          <input type="submit" id="btn-submit" value="Enviar">
                    </div>
          </form>
                    </body>
</html>
