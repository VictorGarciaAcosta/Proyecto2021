<?php
error_reporting(0);
//Incluimos las clases necesarias para llamadas a funciones, iniciamos las sesiones y obtenemos los datos para el listado de productos
//Y controlamos si el usuario es administrador o si no esta logeado, esto se realiza en todas las vistas.
include('../modelo/videojuego.php');
session_start();

$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];

$ar = array($nombre, $administrador);
json_encode($ar);
$listado = producto::getUserInfo($_SESSION['id_usuario']);
if($_SESSION['ActualizarDatos']){
    $listado = producto::getUserInfo($_SESSION['ActualizarDatos']);
    $_SESSION['ActualizarDatos'] ="";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
    body{
        text-align: center;
    }
    </style>
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
        <form action="../controlador/modificar.php" method="post" class="formularios">                

                <p><b>Nombre </b><?php echo $listado['NOMBRE']; ?></p>
                <p><b>Apellidos </b><?php echo $listado['APELLIDOS']; ?></p>
                <p><b>Email </b><?php echo $listado['EMAIL']; ?></p>
                <p><b>Direccion </b><?php echo $listado['DIRECCION']; ?></p>
                <br>
            
            <br>
            <label for="">Nombre</label><br><input type="text" name="NOMBRE" value="<?php echo $listado['NOMBRE']?>" ><br>
            <label for="">Apellidos</label><br><input type="text" name="APELLIDOS" value="<?php echo $listado['APELLIDOS']?>" required><br>
            <label for="">EMAIL</label><br><input type="email" name="EMAIL" value="<?php echo $listado['EMAIL']?>" required><br>
            <label for="">DIRECCION</label><br><input type="text" name="DIRECCION" value="<?php echo $listado['DIRECCION']?>" required><br>
            <input type="hidden" name="id_usuario" value="<?php echo $listado['ID_USUARIO']; ?>">
            <br>
            <input type="submit" value="Aceptar Cambios" name="AceptarCambios">
        </form>
        </fieldset>
    </div>
</body>
</html>