<?php
////////////////// CONEXION A LA BASE DE DATOS ////////////////////////////////////
$host="localhost";
$usuario="root";
$contraseña="";
$base="login";

$conexion= new mysqli($host, $usuario, $contraseña, $base);
if ($conexion -> connect_errno)
{
	die("Fallo la conexion:(".$conexion -> mysqli_connect_errno().")".$conexion-> 
		mysqli_connect_error());
}

/////////////////////// CONSULTA A LA BASE DE DATOS ////////////////////////
$resAlumnos=$conexion->query("SELECT * FROM producto ORDER BY cod_producto");


///TABLA DONDE SE DESPLIEGAN LOS REGISTROS //////////////////////////////
echo '<table class="table" style="font-size:12px; margin-top:-1%;">

				<tr class="active">
					<th>ID</th>
					<th>NOMBRE</th>
					<th>PRECIO</th>
					<th>STOCK</th>
				</tr>';

				while ($filaAlumnos = $resAlumnos->fetch_array(MYSQLI_BOTH))
				{
					echo'<tr>
						 <td>'.$filaAlumnos['cod_producto'].'</td>
						 <td>'.$filaAlumnos['nom_producto'].'</td>
						 <td>'.$filaAlumnos['precio'].'</td>
						 <td>'.$filaAlumnos['stock'].'</td>
						 </tr>';
				}
				echo '</table>';
?>