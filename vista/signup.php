<link rel="stylesheet" href="../styles/formulario.css">
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
    <a href="login.php"><button type="button" name="login" value="login">log in</button></a>
</form>