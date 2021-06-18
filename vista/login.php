<?php
error_reporting(0);

include('../modelo/videojuego.php');

$usuarios = producto::getAllUsers();

$usuariosNombre=[];
$usuariosPass=[];
foreach($usuarios as $nombre){
    $usuariosNombre[] = $nombre['NOMBRE'];
    $usuariosPass[] = $nombre['CONTRASENA'];
}
$usuariosNombre[] = "Victor";
$usuariosPass[] = "contrasena";


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/formulario.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("formulario").addEventListener('submit', validarFormulario);
        });

        function validarFormulario(evento) {
            evento.preventDefault();
            var nombres = <?php echo json_encode($usuariosNombre) ?>;
            var contrasena = <?php echo json_encode($usuariosPass) ?>;
            console.log(nombres);
            console.log(contrasena);
            var usuario = document.getElementById('nombre').value;
            if (!nombres.includes(usuario)) {
                alert('Este nombre de Usuario no Existe');
                return;
            }
            var clave = document.getElementById('Contrasena').value;
            console.log(clave);
            console.log(contrasena)
            if (!contrasena.includes(clave)) {
                alert('Las credenciales son incorrectas');
                return;
            }
            this.submit();
        }
    </script>
</head>

<body>
    <form method="post" action="../controlador/login.php" name="signin-form" id="formulario">
        <div class="form-element">
            <label>nombre</label>
            <input type="text" name="nombre" id="nombre" required />
        </div>
        <div class="form-element">
            <label>Contrasena</label>
            <input type="password" name="Contrasena" id="Contrasena" required />
        </div>
        <button type="submit" name="login" value="login">Log In</button>
        <a href="signup.php"><button type="button" name="signup" value="signup">Sign up</button></a>
    </form>
</body>

</html>