<?php
    class Conexion extends PDO {
      private $datos = "mysql:host=localhost;dbname=proyectovideojuegos;charset=utf8mb4";
      private $usuario = "admin";
      private $pass = "admin"; 
      public function __construct(){
         try{
            parent::__construct($this->datos, $this->usuario, $this->pass);
         }catch(PDOException $e){
            echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
            exit;
         } 
      }      
  }  
?>
