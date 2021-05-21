<?php
	include ('../modelo/conexion.php');

	session_start();
	$_SESSION['nombre'] = $_POST['nombre'];
	$_SESSION['contrasena'] = $_POST['Contrasena'];
	

	header("Location: ../modelo/asignarUsuarios.php");
?>