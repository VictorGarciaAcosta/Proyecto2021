<?php

    include ('../modelo/conexion.php');
    include ('../modelo/videojuego.php');
    session_start();
    /**
     * En este controlador se distingue entre los botones pulsados para Eliminar, Modificar, Comprar y Añadir a la lista de deseados
     * En el caso de Eliminar simplemente se ejecuta la funcion de 'videojuego' 'delete()' entregandole los valores
     * del videojuego a Eliminar.
     *
     * En el caso de que se elija Modificar cargara la vista modificar.php y espera la confirmación del
     * usuario. Cuando recibe Aceptar cargara los datos modificados en un objeto 'videojuego'
     * y lleva a cabo la modificacion mediante la funcion 'modify()'.
     * 
     */
    $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"],(float)$_POST['id_producto']);
    $_SESSION['id_producto'] = $_POST['id_producto1'];
    $array = [(float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"],(float)$_POST['id_producto']];
    $_SESSION['Producto1'] = $array;
    if ($_POST["opcion"]=="Eliminar") {            
        $producto->delete();
        
        header("Location: admin.php");
        
    }elseif($_POST["opcion"]=="Modificar"){
        header ('Location: ../vista/modificar.php');
    }elseif($_POST["opcion"]=="Comprar"){

    }elseif(($_POST["opcion"]=="Añadir a la lista de deseados")){

    }

?>