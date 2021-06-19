<?php
	include ('../modelo/conexion.php');

	session_start();
	//Borramos todas las sesiones de usuario
	unset($_SESSION['user']);
    unset($_SESSION['administrador']);
    unset($_SESSION['nombre']);
    unset($_SESSION['Contrasena']);

	header("Location: ../modelo/asignarUsuarios.php");
?>