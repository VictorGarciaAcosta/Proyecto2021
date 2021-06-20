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
            //controlamos que las contraseñas coincidan.
            evento.preventDefault();
            var clave = document.getElementById('pass1').value;
            var clave2 = document.getElementById('pass2').value;

            if (clave != clave2) {
                alert('Las Contraseñas no coinciden');
                return;
            }
            this.submit();
        }

    </script>
</head>

<body>
    <form method="post" action="../controlador/modificar.php" name="signin-form" id="formulario">
        <div class="form-element">
            <label>Contrasena</label>
            <input type="password" name="Contrasena" id="pass1" required />
        </div>
        <div class="form-element">
            <label>Otra vez </label>
            <input type="password" name="Contrasena1" id="pass2" required />
        </div>

        <button type="submit" name="CambiarPassword" value="CambiarPassword">Cambiar Password</button>
    </form>
</body>

</html>