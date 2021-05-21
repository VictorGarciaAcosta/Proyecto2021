<?php
	
	include ('conexion.php');

	session_start();

	$conn = new Conexion();

	$nombre = $_SESSION['nombre'];
	$contrasena = $_SESSION['contrasena'];

	echo $_SESSION['nombre'];
	echo $_SESSION['contrasena'];

	$query = $conn->prepare("SELECT ADMINISTRADOR,NOMBRE FROM usuario WHERE NOMBRE=:nombre AND CONTRASENA =:contrasena");
	$query->bindParam("nombre", $nombre, PDO::PARAM_STR);
	$query->bindParam("contrasena", $contrasena, PDO::PARAM_STR);
	$query->execute();

		/*$sql = "SELECT administrador FROM usuarios WHERE Nombre ='".$_POST['nombre']."'";
		$resultados = mysqli_query($conexion,$sql) or die(mysqli_error($conexion));

		if ($fila = mysqli_fetch_array($resultados)) {
	       	$_SESSION['administrador'] = $fila['administrador'];
	    }*/ 
	$result = $query->fetchAll();


	echo $result;
	

	if ($result) {
		$_SESSION['administrador'] = $result[0][0];
		$_SESSION['user'] = $result[0][1];
	}else{
		$_SESSION['user'] = "Ninguno";
		$_SESSION['administrador'] = "Ninguno";
		$nombre = "Ninguno";
		$administrador = "Ninguno";
	}


	if (isset($_SESSION['administrador'])) {
		$nombre = $_SESSION['user'];
		$administrador = $_SESSION['administrador'];
	}
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