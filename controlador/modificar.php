<?php
    include ('../modelo/conexion.php');
    include ('../modelo/videojuego.php');

    if (isset($_POST["Aceptar"])) {
        

        $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"],$_POST["id_producto"]);
        $producto->modify();
        header("Location: admin.php");

    }
?>