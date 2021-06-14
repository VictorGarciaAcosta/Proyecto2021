<?php
    include ('../modelo/conexion.php');
    include ('../modelo/videojuego.php');
    session_start();
    if (isset($_POST["Aceptar"])) {
        

        $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"],$_POST["id_producto"]);
        $producto->modify();
        header("Location: admin.php");

    }elseif(isset($_POST["AceptarCambios"])){
        producto::UpdateUser((float)$_SESSION['id_usuario'],$_POST['NOMBRE'],$_POST["APELLIDOS"],$_POST["EMAIL"],$_POST["DIRECCION"]);
        header("Location: ../vista/Perfil.php");
    }
    elseif(isset($_POST["CambiarPassword"])){
        producto::ChangePassword((float)$_SESSION['id_usuario'],$_POST["Contrasena"]);
        header("Location: ../vista/Perfil.php");
    }
?>