<?php
error_reporting(0);
//Incluimos las clases necesarias para llamadas a funciones, iniciamos las sesiones y obtenemos los datos para el listado de productos
//Y controlamos si el usuario es administrador o si no esta logeado, esto se realiza en todas las vistas.
include('../modelo/videojuego.php');


session_start();
$indice = $_SESSION['Producto1'];
$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];

$ar = array($nombre, $administrador);
json_encode($ar);
$user = producto::getUserInfo((float)$_SESSION['id_usuario']);
$categoria = producto::getCategoria($indice[3]);
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
        <form action="../controlador/AddValoracion.php" method="post" class="formularios">
        <legend name="<?php echo $indice[5]; ?>"><?php echo $indice[5]; ?> </legend>
                    <img src="<?php echo $indice[2]; ?>" alt="<?php echo $indice[5]; ?>">
                    <p><b>Descripcion: <br /> </b><?php echo $indice[4]; ?></p>
                    <p class="bloque"> <b>Categoria </b><?php echo $categoria['NOMBRE_CATEGORIA']; ?></p>
                    <p class="bloque"><b>Precio </b><?php echo $indice[0] . "€"; ?></p>
                    <p class="bloque"><b>Stock </b><?php echo $indice[1] . " unidades"; ?></p>
            <br>
        
            <label for="">Puntuacion</label><br><input type="number" name="Puntuacion" min="1" max="5" required><br>
            <label for="">Comentario</label><br><textarea name="Comentario" cols="30" rows="10" required></textarea><br>
            <input type="submit" value="Puntuar" name="opcion">
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