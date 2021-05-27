<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/formulario.css">
</head>
<body>
    <form method="post" action="../controlador/login.php" name="signin-form">
        <div class="form-element">
            <label>nombre</label>
            <input type="text" name="nombre" required />
        </div>
        <div class="form-element">
            <label>Contrasena</label>
            <input type="password" name="Contrasena" required />
        </div>
        <button type="submit" name="login" value="login">Log In</button>
        <a href="signup.php"><button type="button" name="signup" value="signup">Sign up</button></a>
    </form>
</body>

</html>