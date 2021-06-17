<?php

    include ('../modelo/conexion.php');
    include ('../modelo/videojuego.php');

    if (isset($_POST["Añade"])) {

        $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"],0);
        $producto->insert();
        header("Location: ../index.php");

    }

?>