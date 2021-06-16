<?php

error_reporting(E_ALL);

include('../modelo/videojuego.php');
session_start();

$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];
$user = producto::getUserInfo($_SESSION['id_usuario']);
$ar = array($nombre, $administrador);
json_encode($ar);
$HistorialCompra = producto::getHistorialCompra((float)$_SESSION['id_usuario']);
$PrecioTotal =0;

$Usuarios = producto::getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../javascript/gestionUsuario.js"></script>
    <script>
        $(document).ready(function() {
            var ar = <?php echo json_encode($ar) ?>;
            comprobarUsuario(ar);

            function comprobarUsuario(oDatos) {
                
                if (oDatos[0] == "Ninguno") {
                    document.getElementById('Perfil').style.display = 'none';
                    document.getElementById('Carrito').style.display = 'none';
                    document.getElementById('Lista').style.display = 'none';
                    document.getElementById('Logout').style.display = 'none';
                    
                    document.getElementById('Signup').style.display = 'initial';
                    document.getElementById('Login').style.display = 'initial';
                } else {
                    document.getElementById('Login').style.display = 'none';
                    document.getElementById('Perfil').style.display = 'initial';
                    document.getElementById('Signup').style.display = 'none';
                    
                    if (oDatos[1] == '0') {
                        document.getElementById('Gestion').style.display = 'none';
                        
                    } else {
                        if (oDatos[1] == '1') {
                            document.getElementById('Lista').style.display = 'none';
                            document.getElementById('Carrito').style.display = 'none';
                            document.getElementById('Historial').style.display = 'none';
                            
                            
                        }
                    }
                }
            }
            

        });
    </script>
    <title>Tienda Videojuegos</title>
</head>

<body>
    <!-- Pagina de Inicio   -->
    <ul>
        <li><a href="../modelo/asignarUsuarios.php">Inicio</a></li>
        <li id="Lista"><a href="ListaDeseados.php">Listado de Deseados</a></li>
        <li id="Carrito"><a href="Carrito.php">Carrito</a></li>
        <li><a href="Valoraciones.php">Valoraciones</a></li>

        <li id="Perfil"><a href="Perfil.php" class="perfil"><img src="../IMAGENES/perfil.jpg" alt="Perfil" style="width: 40px; height:30px;" /></a></li>

        <li id="Login"><a href="login.php">Log In</a></li>
        <li id="Signup"><a href="signup.php">Sign up</a></li>
        <li id="Logout"><a href="../controlador/Logout.php">Log Out</a></li>

    </ul>
    <div class="content">
    <fieldset>
                <legend name="<?php echo $user['NOMBRE']; ?>"><b>Nombre </b><?php echo $user['NOMBRE']; ?> </legend>
                <p><b>Apellidos </b><?php echo $user['APELLIDOS']; ?></p>
                <p><b>Email </b><?php echo $user['EMAIL']; ?></p>
                <p><b>Direccion </b><?php echo $user['DIRECCION']; ?></p>
                <br>
                <form action="../controlador/control.php" method="post">
                    <input type="submit" value="Cambiar Contrasena" name="opcion" class="Cambiar Contrasena"> 
                    <input type="submit" value="Actualizar Datos" name="opcion" class="Actualizar Datos"> 
                </form>
    </fieldset>
    <br>
    <div id="Historial">
    <?php
    
    if (empty($HistorialCompra)) {
            echo "No Se han Realizado Compras";
            
        } else {
            ?>
            <h1>Historial de Compras</h1>
            <?php
            foreach ($HistorialCompra as $Pedido) {
                $detalles = producto::getProductosCarrito($Pedido['ID_PEDIDO']);
                foreach($detalles as $producto){
                
                $juego = producto::getJuego($producto['ID_PRODUCTO']);
                $categoria = producto::getCategoria($juego['ID_CATEGORIA']);
                $PrecioTotal = $PrecioTotal + $juego['PRECIO'];
                
        ?>
            
                <fieldset>
                    <p class="bloque" name="<?php echo $juego['NOMBRE_PRODUCTO']; ?>"><?php echo $juego['NOMBRE_PRODUCTO']; ?> </p>
                    <p class="bloque"><b>Precio </b><?php echo $juego['PRECIO'] . "€"; ?></p>
                    <br>
                    <form action="../controlador/control.php" method="post">
                        <input type="hidden" name="nombre_producto" value="<?php echo $juego['NOMBRE_PRODUCTO']; ?>">
                        <input type="hidden" name="descripcion" value="<?php echo $juego['DESCRIPCION']; ?>">
                        <input type="hidden" name="id_categoria" value="<?php echo $juego['ID_CATEGORIA']; ?>">
                        <input type="hidden" name="imagen" value="<?php echo $juego['IMAGEN']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $juego['PRECIO']; ?>">
                        <input type="hidden" name="stock" value="<?php echo $juego['STOCK']; ?>">
                        <input type="hidden" name="pedido" value="<?php echo $producto['ID_PEDIDO']; ?>">
                        <input type="hidden" name="id_producto1" value="<?php echo $juego['ID_PRODUCTO']; ?>">
                        <input type="hidden" name="id_producto" value="<?php echo $juego['ID_PRODUCTO']; ?>">                     
                        <input type="submit" value="Devolver" name="opcion" class="Devolver">  
                    </form>
                </fieldset>
        <?php
                }
            }
        }
        ?>
        <h2>Precio Total <?php echo $PrecioTotal. "€"; ?></h2>
        <br><br><br><br>
    </div>
    <div id="Gestion">
        <h1>Gestion de Usuarios</h1>
        <?php
            foreach($Usuarios as $Usuario){
                ?>
                <fieldset>
                    <p class="bloque" name="<?php echo $Usuario['NOMBRE']." ".$Usuario['APELLIDOS']; ?>"><b><?php echo $Usuario['NOMBRE']." ".$Usuario['APELLIDOS']; ?></b> </p>
                    <p><b>Email </b><?php echo $Usuario['EMAIL']; ?></p>
                    <p><b>Direccion </b><?php echo $Usuario['DIRECCION']; ?></p>
                    <form action="../controlador/control.php" method="post">
                        <input type="hidden" name="id_usuario" value="<?php echo $Usuario['ID_USUARIO']; ?>">                     
                        <input type="submit" value="BorrarUser" name="opcion" class="BorrarUser">
                        <input type="submit" value="ActualizarDatos" name="opcion" class="ActualizarDatos"> 
                    </form>
                </fieldset>
            <?php
            }
        ?>
        <br><br><br><br>
    </div>
    </div>
    <aside>
        <div class="social">

        </div>
    </aside>
    <div class="footer">
            <p class="footer-content"><?php echo $user['DIRECCION'];?></p>
            <p class="footer-content" id="telefono">627120850</p>
            <p class="footer-content"><?php echo $user['EMAIL'];?></p>
        </div>
</body>

</html>