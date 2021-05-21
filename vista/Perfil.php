<?php


session_start();

$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];

$ar = array($nombre, $administrador);
json_encode($ar);
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
                    document.getElementById('Comprar').style.display = 'none';
                    document.getElementById('Eliminar').style.display = 'none';
                    document.getElementById('Modificar').style.display = 'none';
                    document.getElementById('ListaDeseados').style.display = 'none';
                    document.getElementById('Carrito').style.display = 'none';
                    document.getElementById('Lista').style.display = 'none';
                    document.getElementById('Logout').style.display = 'none';
                    document.getElementById('Add').style.display = 'none';
                    document.getElementById('Signup').style.display = 'initial';
                    document.getElementById('Login').style.display = 'initial';
                } else {
                    document.getElementById('Login').style.display = 'none';
                    document.getElementById('Perfil').style.display = 'initial';
                    document.getElementById('Signup').style.display = 'none';

                    if (oDatos[1] == '0') {
                        document.getElementById('Modificar').style.display = 'none';
                        document.getElementById('Eliminar').style.display = 'none';
                        document.getElementById('Add').style.display = 'none';
                    } else {
                        if (oDatos[1] == '1') {
                            document.getElementById('ListaDeseados').style.display = 'none';
                            document.getElementById('Lista').style.display = 'none';
                            document.getElementById('Carrito').style.display = 'none';
                            document.getElementById('Comprar').style.display = 'none';
                        }
                    }
                }
            }
            //$.get("asignarUsuarios.php",comprobarUsuario,'json');

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
        <li><input type="search" id="search" placeholder="Busca articulos"></li>
        <li><button type="submit" id="btn-search">Busqueda</button></li>

        <li id="Perfil"><a href="Perfil.php" class="perfil"><img src="../IMAGENES/perfil.jpg" alt="Perfil" style="width: 40px; height:30px;" /></a></li>

        <li id="Login"><a href="login.php">Log In</a></li>
        <li id="Signup"><a href="signup.php">Sign up</a></li>
        <li id="Logout"><a href="../controlador/Logout.php">Log Out</a></li>

    </ul>
    <div class="content">
        <div id="caja">

        </div>
        <form action="" id="Add"><input type="submit" value="Add"></form>
        <form action="" id="Comprar"><input type="submit" value="Comprar"></form>
        <form action="" id="Eliminar"><input type="submit" value="Eliminar"></form>
        <form action="" id="Modificar"><input type="submit" value="Modificar"></form>
        <form action="" id="ListaDeseados"><input type="submit" value="Añadir a la lista de deseados"></form>
    </div>

    <aside>
        <div class="social">

        </div>
    </aside>
    <div class="footer">
        <p class="footer-content">C/binefar bloque 3 1ºA</p>
        <p class="footer-content" id="telefono">627120850</p>
        <p class="footer-content">caiman3lol@gmail.com</p>
    </div>
</body>

</html>