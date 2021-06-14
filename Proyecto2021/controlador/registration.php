<?php
 
include ('../modelo/conexion.php');
session_start(); 

$conn = new Conexion();

 
if (isset($_POST['register'])) {
 
    $Nombre = $_POST['Nombre'];
    $Apellidos = $_POST['Apellidos'];
    $Direccion = $_POST['Direccion'];
    $email = $_POST['email'];
    echo $email;
    $administrador = 0;
    $password1 = $_POST['Contrasena'];
    //$password_hash = password_hash($password, PASSWORD_BCRYPT);
 
    $query1 = $conn->prepare("SELECT * FROM usuario WHERE EMAIL=:email");
    $query1->bindParam("email", $email, PDO::PARAM_STR);
    $query1->execute();
 
    if ($query1->rowCount() > 0) {
        echo '<p class="error">The email address is already registered!</p>';
        header("Location: ../vista/signup.php");
    }
 
    if ($query1->rowCount() == 0) {
        $query = $conn->prepare("INSERT INTO usuario(NOMBRE,APELLIDOS,DIRECCION,ADMINISTRADOR,CONTRASENA,EMAIL) VALUES (:Nombre,:Apellidos,:Direccion,:administrador,
        :password1,:email)");
        $query->bindParam("Nombre", $Nombre, PDO::PARAM_STR);
        $query->bindParam("Apellidos", $Apellidos, PDO::PARAM_STR);
        $query->bindParam("Direccion", $Direccion, PDO::PARAM_STR);
        $query->bindParam("administrador", $administrador, PDO::PARAM_STR);
        $query->bindParam("password1", $password1, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $result = $query->execute();
 
        if ($result) {
            echo '<p class="success">Your registration was successful!</p>';
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
$conn=null;
header("Location: ../vista/login.php");
?>