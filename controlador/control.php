<?php

    include ('../modelo/conexion.php');
    include ('../modelo/videojuego.php');

    /**
     * En este controlador se distingue entre los botones pulsados para Borrar o para Modificar.
     * En el caso de Borrar simplemente se ejecuta la funcion de 'producto' 'delete()' entregandole los valores
     * del producto a borrar.
     * 
     * En el caso de que se elija Modificar cargara la vista modificar.php y espera la confirmación del
     * usuario. Cuando recibe Aceptar cargara los datos modificados en un objeto 'producto'
     * y lleva a cabo la modificacion mediante la funcion 'modify()'.
     * 
     */

    if ($_POST["opcion"]=="Eliminar") {    
        $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"]);
        
        $producto->delete();
        
        header("Location: admin.php");
        
    }else{
        /*
            En la modificacion del producto no se modifica la fecha con la que fue creada.     
        */
        if (isset($_POST["Aceptar"])) {
            $producto=new producto((float)$_POST["precio"], (float)$_POST["stock"], $_POST["imagen"],(int)$_POST["id_categoria"],$_POST["descripcion"],$_POST["nombre_producto"]);
            $producto->modify();

            header("Location: admin.php");    
        }

        header ('Location: ../vista/modificar.php');
    }

?>