<?php
error_reporting(E_ALL);
include ('../modelo/conexion.php');
include ('../modelo/videojuego.php');
session_start();
//añade la valoracion a la BBDD
if(($_POST["opcion"]=="Puntuar")){
        producto::AnadirValoracion((float)$_SESSION['id_usuario'],(float)$_SESSION['id_producto'],(float)$_POST['Puntuacion'],$_POST['Comentario']);
        header("Location: ../vista/Valoraciones.php");
    }
?>