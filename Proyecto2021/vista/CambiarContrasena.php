<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/formulario.css">
</head>

<body>
    <form method="post" action="../controlador/modificar.php" name="signin-form">
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