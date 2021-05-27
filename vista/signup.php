<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/formulario.css">
</head>

<body>
    <form method="post" action="../controlador/registration.php" name="signup-form">
        <div class="form-element">
            <label>Nombre</label>
            <input type="text" name="Nombre" pattern="[a-zA-Z0-9]+" required />
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
            <input type="password" name="Contrasena" required />
        </div>
        <button type="submit" name="register" value="register">Register</button>
        <a href="login.php"><button type="button" name="login" value="login">log In</button></a>
    </form>
</body>

</html>