<?php
	
	include ('conexion.php');

	session_start();

	$conn = new Conexion();

	$nombre = $_SESSION['nombre'];
	$contrasena = $_SESSION['contrasena'];

	$query = $conn->prepare("SELECT ADMINISTRADOR,NOMBRE,ID_USUARIO FROM usuario WHERE NOMBRE=:nombre AND CONTRASENA =:contrasena");
	$query->bindParam("nombre", $nombre, PDO::PARAM_STR);
	$query->bindParam("contrasena", $contrasena, PDO::PARAM_STR);
	$query->execute();

	$result = $query->fetchAll();

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
	//envia la un array con los datos del usuario para recogerlo y gestionarlo desde el
	/*enviarResultados($nombre,$administrador);

	function enviarResultados($nombre,$administrador){
	    // Generar la respuesta
	    header('Content-Type: application/json');

		$respuesta['nombre'] = $nombre;
		$respuesta['administrador'] = $administrador;

    	echo json_encode($respuesta);		
	}*/
	$conn=null;
	header("Location: ../index.php");
?>