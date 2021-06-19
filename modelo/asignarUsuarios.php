<?php
	
	include ('conexion.php');
	
	session_start();

	$conn = new Conexion();

	$nombre = $_SESSION['nombre'];
	$contrasena = $_SESSION['contrasena'];

	//realizamos una query con los datos del usuario para obtener si es administrador o no y lo guardamos en sesiones
	$query = $conn->prepare("SELECT ADMINISTRADOR,NOMBRE,ID_USUARIO FROM usuario WHERE NOMBRE=:nombre AND CONTRASENA =:contrasena");
	$query->bindParam("nombre", $nombre, PDO::PARAM_STR);
	$query->bindParam("contrasena", $contrasena, PDO::PARAM_STR);
	$query->execute();

	$result = $query->fetchAll();

	//Tambien guardamos el id_usuario para simplificacion de obtencion de datos de este
	if ($result) {
		$_SESSION['administrador'] = $result[0][0];
		$_SESSION['user'] = $result[0][1];
		$_SESSION['id_usuario'] = $result[0][2];
	}else{
		$_SESSION['user'] = "Ninguno";
		$_SESSION['administrador'] = "Ninguno";
		$_SESSION['id_usuario'] = 0;
		$nombre = "Ninguno";
		$administrador = "Ninguno";
	}


	if (isset($_SESSION['administrador'])) {
		$nombre = $_SESSION['user'];
		$administrador = $_SESSION['administrador'];
	}
	$conn=null;
	header("Location: ../index.php");
?>