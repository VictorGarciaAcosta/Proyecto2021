<?php
    include ('../modelo/conexion.php');
    include ('../modelo/videojuego.php');
    session_start();
    //este fichero controla los modificar de producto,  datos de usuario y contraseñas
    if (isset($_POST["Aceptar"])) {
        

        $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"],$_POST["id_producto"]);
        $producto->modify();
        header("Location: ../index.php");

    }elseif(isset($_POST["AceptarCambios"])){
        producto::UpdateUser((float)$_POST['id_usuario'],$_POST['NOMBRE'],$_POST["APELLIDOS"],$_POST["EMAIL"],$_POST["DIRECCION"]);
        header("Location: ../vista/Perfil.php");
    }
    else{
        producto::ChangePassword((float)$_SESSION['id_usuario'],$_POST["Contrasena"]);
        header("Location: ../vista/Perfil.php");
    }
?>