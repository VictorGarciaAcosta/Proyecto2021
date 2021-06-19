<?php
error_reporting(0);

include('../modelo/videojuego.php');
//Incluimos las clases necesarias para llamadas a funciones, iniciamos las sesiones y obtenemos los datos para el listado de productos
//Y controlamos si el usuario es administrador o si no esta logeado, esto se realiza en todas las vistas.

session_start();

$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];

$ar = array($nombre, $administrador);
json_encode($ar);
$user = producto::getUserInfo((float)$_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
    body{
        text-align: center;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                        
                    } else {
                        if (oDatos[1] == '1') {
                            document.getElementById('Lista').style.display = 'none';
                            document.getElementById('Carrito').style.display = 'none';
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
        <fieldset class="formularios">
        <form action="../controlador/add.php" method="post">
            <label for="">nombre_producto</label><br><input type="text" name="nombre_producto" required><br>
            <label for="">descripcion</label><br><textarea name="descripcion" cols="30" rows="10" required></textarea><br>
            <label for="">id_categoria</label><br><input type="text" name="id_categoria" required><br>
            <label for="">imagen</label><br><input type="text" name="imagen" required><br><br>
            <label for="">precio</label><br><input type="text" name="precio" required><br>
            <label for="">stock</label><br><input type="text" name="stock" required><br><br>
            <input type="submit" value="Añade" name="Añade">
        </form>
        </fieldset>
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