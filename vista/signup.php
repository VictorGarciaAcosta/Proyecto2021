<?php
error_reporting(0);

include('../modelo/videojuego.php');
//Controlamos que no se cree un usuario con el mismo nombre, y que la contraseña coincida

$usuarios = producto::getAllUsers();

$usuariosNombre=[];

foreach($usuarios as $nombre){
    $usuariosNombre[] = $nombre['NOMBRE'];

}
$usuariosNombre[] = "Victor";

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
            //evitamos que haga el submit hasta el final de la funcion
            evento.preventDefault();
            var nombres = <?php echo json_encode($usuariosNombre) ?>;

            var usuario = document.getElementById('nombre').value;
            if (nombres.includes(usuario)) {
                alert('Este nombre de Usuario ya Existe');
                return;
            }
            var clave = document.getElementById('Contrasena').value;
            var clave2 = document.getElementById('ConfirmarContrasena').value;

            if (clave != clave2) {
                alert('Las Contraseñas no coinciden');
                return;
            }
            this.submit();
        }
    </script>
</head>

<body>
    <form method="post" action="../controlador/registration.php" name="signup-form" id="formulario">
        <div class="form-element">
            <label>Nombre</label>
            <input type="text" name="Nombre" pattern="[a-zA-Z0-9]+" required id="nombre"/>
        </div>
        <div class="form-element">
            <label>Apellidos</label>
            <input type="text" name="Apellidos" required />
        </div>
        <div class="form-element">
            <label>Email</label>
            <input type="email" name="email" required />
        </div>
        <div class="form-element">
            <label>Direccion</label>
            <input type="text" name="Direccion" required />
        </div>
        <div class="form-element">
            <label>Contrasena</label>
            <input type="password" name="Contrasena" id="Contrasena" required />
        </div>
        <div class="form-element">
            <label>Confirmar</label>
            <input type="password" name="ConfirmarContrasena" id="ConfirmarContrasena" required />
        </div>
        <button type="submit" name="register" value="register">Register</button>
        <a href="login.php"><button type="button" name="login" value="login">log In</button></a>
    </form>
</body>

</html>