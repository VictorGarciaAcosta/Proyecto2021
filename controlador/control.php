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

    //Elimina el stock de un producto
    if ($_POST["opcion"]=="Eliminar") {            
        $producto->delete();
        
        header("Location: ../index.php");
        
    }//modifica los datos de un producto
    elseif($_POST["opcion"]=="Modificar"){
        header ('Location: ../vista/modificar.php');

    }//Añade a la lista de deseados de ese usuario, un producto
    elseif(($_POST["opcion"]=="Añadir a la lista de deseados")){
        producto::AnadirDeseado((float)$_SESSION['id_usuario'],(float)$_SESSION['id_producto']);
        header("Location: ../index.php");

    }//Elimina de la lista de deseados de ese usuario, un producto
    elseif(($_POST["opcion"]=="Eliminar de la lista de deseados")){
        producto::EliminarDeseado((float)$_SESSION['id_usuario'],(float)$_SESSION['id_producto']);
        header("Location: ../vista/ListaDeseados.php");
    }
    //Actualiza los datos de un usuario
    elseif(($_POST["opcion"]=="Actualizar Datos")){
        header("Location: ../vista/modificarUsuario.php");
        
    }
    //Actualiza la contraseña de un usuario
    elseif(($_POST["opcion"]=="Cambiar Contrasena")){
        header("Location: ../vista/CambiarContrasena.php");
    }
    //Elimina la valoracion de un usuario
    elseif(($_POST["opcion"]=="Borrar")){
        producto::BorrarComentario((float)$_POST['id_usuarioborrar'],(float)$_SESSION['id_producto'],$_POST['comentario']);
        header("Location: ../vista/Valoraciones.php");
    }
    //Redirige a la valoracion de un producto
    elseif(($_POST["opcion"]=="Valorar")){
        header("Location: ../vista/AnadirValoraciones.php");
    }
    //Elimina del carrito un producto y aumenta el stock del producto en cuestion
    elseif(($_POST["opcion"]=="BorrarDelCarrito")){
        $pedido = producto::getCarrito((float)$_SESSION['id_usuario']);
        $cantidad = producto::BorrarPedido((float)$pedido['ID_PEDIDO'],(float)$_SESSION['id_producto']);
        producto::DevuelveCompra((float)$_SESSION['id_producto'],(float)$cantidad);
        header("Location: ../vista/Carrito.php");
    }
    //Paga el pedido de forma ficticia y adquiere el producto
    elseif(($_POST["opcion"]=="FinalizarCompra")){
        producto::ComprarPedido($_POST['id_pedido']);
        $ProductosPedido = producto::getProductosCarrito($_POST['id_pedido']); 
        $user = producto::getUserInfo((float)$_SESSION['id_usuario']);
        producto::EnviarEmail($user['EMAIL'],$ProductosPedido);
        header("Location: ../vista/Carrito.php");
    }
    //Añade el producto al carrito y resta 1 al stock del producto
    elseif(($_POST["opcion"]=="Comprar")&& (float)$_POST["stock"] > 0 ){
        //crea un pedido si aun no lo tenia
        if(producto::existePedido((float)$_SESSION['id_usuario'])){
            $pedido = producto::getCarrito((float)$_SESSION['id_usuario']);
            producto::ComprarDetalle((float)$pedido['ID_PEDIDO'],(float)$_SESSION['id_producto']);
            producto::RecibeCompra((float)$_SESSION['id_producto']);
            header("Location: ../index.php");
        }//añade productos al pedido ya existente
        else{
            producto::Comprar((float)$_SESSION['id_usuario']);
            $pedido = producto::getCarrito((float)$_SESSION['id_usuario']);
            producto::ComprarDetalle((float)$pedido['ID_PEDIDO'],(float)$_SESSION['id_producto']);
            producto::RecibeCompra((float)$_SESSION['id_producto']);
            header("Location: ../index.php");
        } 
    }
    //devuelve el pedido a stock
    elseif(($_POST["opcion"]=="Devolver")){
        producto::DevolverJuego($_POST['pedido'],$_POST['id_producto']);
        producto::DevuelveCompra($_POST['id_producto'],1);
        header("Location: ../vista/perfil.php");
    }
    //Borra un usuario e informacion derivada de este, a excepcion de los pedidos
    elseif(($_POST["opcion"]=="BorrarUser")){
        producto::BorrarUser($_POST['id_usuario']);
        header("Location: ../vista/perfil.php");

    }//actualiza los datos de un usuario desde administrador
    elseif(($_POST["opcion"]=="ActualizarDatos")){
        $_SESSION['ActualizarDatos'] = $_POST['id_usuario'];
        header("Location: ../vista/modificarUsuario.php");

    }//Si no se ha realizado ninguna accion anterior redirige a la pagina principal
    else{
        header("Location: ../index.php");
    }
    
?>