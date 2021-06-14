<?php
error_reporting(0);

include('./modelo/videojuego.php');
session_start();
if (!isset($_SESSION["administrador"])) {
    header("location: ./controlador/logout.php");
}
$listado = producto::getJuegos();

$nombre = $_SESSION['user'];
$administrador = $_SESSION['administrador'];

$ar = array($nombre, $administrador);
json_encode($ar);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./styles/style.css">
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
                    document.getElementById('Add').style.display = 'none';
                    document.getElementById('Signup').style.display = 'initial';
                    document.getElementById('Login').style.display = 'initial';

                    var comprar = document.getElementsByClassName("Comprar");
                    var i;
                    for (i = 0; i < comprar.length; i++) {
                        comprar[i].style.display = "none";
                    }
                    var comprar = document.getElementsByClassName("Valorar");
                    var i;
                    for (i = 0; i < comprar.length; i++) {
                        comprar[i].style.display = "none";
                    }
                    var eliminar = document.getElementsByClassName("Eliminar");
                    var i;
                    for (i = 0; i < eliminar.length; i++) {
                        eliminar[i].style.display = "none";
                    }
                    var Modificar = document.getElementsByClassName("Modificar");
                    var i;
                    for (i = 0; i < Modificar.length; i++) {
                        Modificar[i].style.display = "none";
                    }
                    var ListaDeseados = document.getElementsByClassName("ListaDeseados");
                    var i;
                    for (i = 0; i < ListaDeseados.length; i++) {
                        ListaDeseados[i].style.display = "none";
                    }
                } else {
                    document.getElementById('Login').style.display = 'none';
                    document.getElementById('Perfil').style.display = 'initial';
                    document.getElementById('Signup').style.display = 'none';

                    if (oDatos[1] == '0') {
                        var eliminar = document.getElementsByClassName("Eliminar");
                        var i;
                        for (i = 0; i < eliminar.length; i++) {
                            eliminar[i].style.display = "none";
                        }
                        var Modificar = document.getElementsByClassName("Modificar");
                        var i;
                        for (i = 0; i < Modificar.length; i++) {
                            Modificar[i].style.display = "none";
                        }
                        document.getElementById('Add').style.display = 'none';
                    } else {
                        if (oDatos[1] == '1') {
                            document.getElementById('Lista').style.display = 'none';
                            document.getElementById('Carrito').style.display = 'none';
                            document.getElementById('Add').style.display = 'initial';

                            var ListaDeseados = document.getElementsByClassName("ListaDeseados");
                            var i;
                            for (i = 0; i < ListaDeseados.length; i++) {
                                ListaDeseados[i].style.display = "none";
                            }
                            var comprar = document.getElementsByClassName("Valorar");
                            var i;
                            for (i = 0; i < comprar.length; i++) {
                                comprar[i].style.display = "none";
                            }
                            var comprar = document.getElementsByClassName("Comprar");
                            var i;
                            for (i = 0; i < comprar.length; i++) {
                                comprar[i].style.display = "none";
                            }
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
        <li><a href="./modelo/asignarUsuarios.php">Inicio</a></li>
        <li id="Lista"><a href="./vista/ListaDeseados.php">Listado de Deseados</a></li>
        <li id="Carrito"><a href="./vista/Carrito.php">Carrito</a></li>
        <li><a href="./vista/Valoraciones.php">Valoraciones</a></li>

        <li><input type="search" list="modelos" id="search" name="search" placeholder="Busca articulos" required></li>
        <li><button type="submit" value="buscar" id="btn-search">Busqueda</button></li>


        <li id="Perfil"><a href="./vista/Perfil.php" class="perfil"><img src="./IMAGENES/perfil.jpg" alt="Perfil" style="width: 40px; height:30px;" /></a></li>
        <li id="Login"><a href="./vista/login.php">Log In</a></li>
        <li id="Signup"><a href="./vista/signup.php">Sign up</a></li>
        <li id="Logout"><a href="./controlador/Logout.php">Log Out</a></li>

    </ul>
    <div class="content">
        <form action="./vista/add.php" id="Add"><input type="submit" value="Add" id="boton-add"></form>
        <?php
        /**
         * Por cada elemento mostrado se generan botones mara el borrado, modificacion, compra o adicion a la lista de deseados del articulo.
         * Esta accion se llevara a cabo en el controlador '/controler/control.php'
         */

        foreach ($listado as $entrada) {
            $categoria = producto::getCategoria($entrada['ID_CATEGORIA']);
        ?>
            <fieldset>
                <legend name="<?php echo $entrada['NOMBRE_PRODUCTO']; ?>"><?php echo $entrada['NOMBRE_PRODUCTO']; ?> </legend>
                <img src="<?php echo $entrada['IMAGEN']; ?>" alt="<?php echo $entrada['NOMBRE_PRODUCTO']; ?>">
                <p><b>Descripcion: <br /> </b><?php echo $entrada['DESCRIPCION']; ?></p>
                <p class="bloque"> <b>Categoria </b><?php echo $categoria['NOMBRE_CATEGORIA']; ?></p>
                <p class="bloque"><b>Precio </b><?php echo $entrada['PRECIO'] . "€"; ?></p>
                <p class="bloque"><b>Stock </b><?php echo $entrada['STOCK'] . " unidades"; ?></p>
                <br>
                <form action="./controlador/control.php" method="post">
                    <input type="hidden" name="nombre_producto" value="<?php echo $entrada['NOMBRE_PRODUCTO']; ?>">
                    <input type="hidden" name="descripcion" value="<?php echo $entrada['DESCRIPCION']; ?>">
                    <input type="hidden" name="id_categoria" value="<?php echo $entrada['ID_CATEGORIA']; ?>">
                    <input type="hidden" name="imagen" value="<?php echo $entrada['IMAGEN']; ?>">
                    <input type="hidden" name="precio" value="<?php echo $entrada['PRECIO']; ?>">
                    <input type="hidden" name="stock" value="<?php echo $entrada['STOCK']; ?>">
                    <input type="hidden" name="id_producto" value="<?php echo $entrada['ID_PRODUCTO']; ?>">
                    <input type="hidden" name="id_producto1" value="<?php echo $entrada['ID_PRODUCTO']; ?>">
                    <input type="submit" value="Modificar" name="opcion" class="Modificar">
                    <input type="submit" value="Comprar" name="opcion" class="Comprar">
                    <input type="submit" value="Añadir a la lista de deseados" name="opcion" class="ListaDeseados">
                    <input type="submit" value="Valorar" name="opcion" class="Valorar">
                    <input type="submit" value="Eliminar" name="opcion" class="Eliminar">
                </form>
            </fieldset>
            <br><br>
        <?php
        }
        ?>
    </div>
    <aside>
        <div class="social">
            <datalist id="modelos">
                <?php
                /**
                 * Por cada elemento mostrado se generan opciones de busqueda*/
                foreach ($listado as $entrada) {
                ?>
                    <option value="<?php echo $entrada['NOMBRE_PRODUCTO']; ?>">
                    <?php }
                    ?>
            </datalist>
        </div>
    </aside>
    <div class="footer">
        <p class="footer-content">C/binefar bloque 3 1ºA</p>
        <p class="footer-content" id="telefono">627120850</p>
        <p class="footer-content">caiman3lol@gmail.com</p>
    </div>
</body>

</html>