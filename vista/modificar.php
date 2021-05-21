<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examen UD5</title>
</head>
<body>
    <!--
        Vista especifica de modificacion de articulo.

    -->
    <form action="../controlador/control.php" method="post">                

        <label for="">nombre_producto</label><br><input type="text" name="nombre_producto" value="<?php echo $_POST["nombre_producto"]; ?>"><br>
        <label for="">descripcion</label><br><textarea name="descripcion" cols="30" rows="10"><?php echo $_POST["descripcion"]; ?></textarea><br>
        <label for="">id_categoria</label><br><input type="text" name="id_categoria" value="<?php echo $_POST["id_categoria"]; ?>"><br>
        <label for="">imagen</label><br><input type="text" name="imagen" value="<?php echo $_POST["imagen"]; ?>"><br>
        <label for="">precio</label><br><input type="text" name="precio" value="<?php echo $_POST["precio"]; ?>"><br>
        <label for="">stock</label><br><input type="text" name="stock" value="<?php echo $_POST["stock"]; ?>"><br>
        
        <input type="submit" value="Aceptar" name="Aceptar">
    </form>
</body>
</html>