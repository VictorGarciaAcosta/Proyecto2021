<?php

    include('../modelo/videojuego.php');
    session_start();
    $indice = $_SESSION['Producto1'];
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
                    <legend name="<?php echo $indice[5]; ?>"><?php echo $indice[5]; ?> </legend>
                    <img src="<?php echo ".".$indice[2]; ?>" alt="<?php echo $indice[5]; ?>">
                    <p><b>Descripcion: <br /> </b><?php echo $indice[4]; ?></p>
                    <p class="bloque"> <b>Categoria </b><?php echo $indice[3]; ?></p>
                    <p class="bloque"><b>Precio </b><?php echo $indice[0] . "€"; ?></p>
                    <p class="bloque"><b>Stock </b><?php echo $indice[1] . " unidades"; ?></p>
            </fieldset>
            <label for="">nombre_producto</label>
            <br>
            <input type="text" name="nombre_producto" value="<?php echo $indice[5]?>" ><br>
            <label for="">descripcion</label><br><textarea name="descripcion" cols="30" rows="10" placeholder="<?php echo $indice[4]?>" required></textarea><br>
            <label for="">id_categoria</label><br><input type="text" name="id_categoria" value="<?php echo $indice[3]?>" required><br>
            <label for="">imagen</label><br><input type="text" name="imagen" value="<?php echo $indice[2]?>" required><br>
            <label for="">precio</label><br><input type="text" name="precio" value="<?php echo $indice[0]?>" required><br>
            <label for="">stock</label><br><input type="text" name="stock" value="<?php echo $indice[1]?>" required><br>
            <input type="hidden" name="id_producto" value="<?php echo $_SESSION['id_producto']; ?>">
            
            
            <input type="submit" value="Aceptar" name="Aceptar">
        </form>
    </div>
</body>
</html>