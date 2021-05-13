<?php
//Configuracion de la conexion a base de datos
$bd_host = "localhost";
$bd_usuario = "root";
$bd_password = "";
$bd_base = "npt";

$link = mysqli_connect($bd_host, $bd_usuario, $bd_password,$bd_base);

//consulta todos los empleados
$sql= mysqli_query($link,"SELECT * FROM plataformas WHERE nombre='".$_GET['nombre']."'");

//muestra los datos consultados
if($sql->num_rows>0) {
	return false;
}else{
	return true;
}
?>
