<?php
    error_reporting(E_ALL);
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

    }elseif(($_POST["opcion"]=="Añadir a la lista de deseados")){
        producto::AnadirDeseado((float)$_SESSION['id_usuario'],(float)$_SESSION['id_producto']);
        header("Location: admin.php");
    }
    elseif(($_POST["opcion"]=="Eliminar de la lista de deseados")){
        producto::EliminarDeseado((float)$_SESSION['id_usuario'],(float)$_SESSION['id_producto']);
        header("Location: ../vista/ListaDeseados.php");
    }
    elseif(($_POST["opcion"]=="Actualizar Datos")){
        header("Location: ../vista/modificarUsuario.php");
        
    }
    elseif(($_POST["opcion"]=="Cambiar Contrasena")){
        header("Location: ../vista/CambiarContrasena.php");
    }
    elseif(($_POST["opcion"]=="Borrar")){
        producto::BorrarComentario((float)$_POST['id_usuarioborrar'],(float)$_SESSION['id_producto'],$_POST['comentario']);
        header("Location: ../vista/Valoraciones.php");
    }
    elseif(($_POST["opcion"]=="Valorar")){
        header("Location: ../vista/AnadirValoraciones.php");
    }
    elseif(($_POST["opcion"]=="BorrarDelCarrito")){
        $pedido = producto::getCarrito((float)$_SESSION['id_usuario']);
        producto::BorrarPedido((float)$pedido['ID_PEDIDO'],(float)$_SESSION['id_producto']);
        header("Location: ../vista/Carrito.php");
    }
    elseif(($_POST["opcion"]=="FinalizarCompra")){
        producto::ComprarPedido($_POST['id_pedido']);
        header("Location: ../vista/Carrito.php");
    }
    elseif(($_POST["opcion"]=="Comprar")){
        if(producto::existePedido((float)$_SESSION['id_usuario'])){
            $pedido = producto::getCarrito((float)$_SESSION['id_usuario']);
            producto::ComprarDetalle((float)$pedido['ID_PEDIDO'],(float)$_SESSION['id_producto']);
            header("Location: admin.php");
        }else{
            producto::Comprar((float)$_SESSION['id_usuario']);
            $pedido = producto::getCarrito((float)$_SESSION['id_usuario']);
            producto::ComprarDetalle((float)$pedido['ID_PEDIDO'],(float)$_SESSION['id_producto']);
            header("Location: admin.php");
        } 
    }
    
?>