<?php
error_reporting(E_ALL);

include('../modelo/videojuego.php');
session_start();

$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];

$ar = array($nombre, $administrador);
json_encode($ar);
$listado = producto::getUserInfo($_SESSION['id_usuario']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/style.css">
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
        <form action="../controlador/modificar.php" method="post">                
        <fieldset>
                <legend name="<?php echo $listado['NOMBRE']; ?>"><?php echo $listado['NOMBRE']; ?> </legend>
                <p><b>Apellidos </b><?php echo $listado['APELLIDOS']; ?></p>
                <p><b>Email </b><?php echo $listado['EMAIL']; ?></p>
                <p><b>Direccion </b><?php echo $listado['DIRECCION']; ?></p>
                <br>
                
                    
                
            </fieldset>
            <label for="">Nombre</label><br><input type="text" name="NOMBRE" value="<?php echo $listado['NOMBRE']?>" ><br>
            <label for="">Apellidos</label><br><input type="text" name="APELLIDOS" value="<?php echo $listado['APELLIDOS']?>" required><br>
            <label for="">EMAIL</label><br><input type="text" name="EMAIL" value="<?php echo $listado['EMAIL']?>" required><br>
            <label for="">DIRECCION</label><br><input type="text" name="DIRECCION" value="<?php echo $listado['DIRECCION']?>" required><br>
            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
            <input type="submit" value="Aceptar Cambios" name="AceptarCambios">
        </form>
    </div>
</body>
</html>