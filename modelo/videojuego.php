<?php

    require_once 'conexion.php';
    
    /**
     * 
     * Objeto videojuego.
     * Tiene como parametros precio, stock y imagen
    */

    class producto {
        
        public $precio;
        public $stock;
        public $imagen;
        public $id_categoria;
        public $nombre_producto;
        public $descripcion;
        public $id_producto;

        public function __construct($precio, $stock, $imagen,$id_categoria,$descripcion,$nombre_producto,$id_producto){
            $this->precio = $precio;
            $this->stock = $stock;
            $this->imagen = $imagen;
            $this->id_categoria = $id_categoria;
            $this->nombre_producto = $nombre_producto;
            $this->descripcion = $descripcion;
            $this->id_producto = $id_producto;
        }
        
        public function Mostrar_precio(){
            return $this->precio;
        }
        public function Mostrar_stock(){
            return $this->stock;
        }
        public function Mostrar_imagen(){
            return $this->imagen;
        }
        public function Mostrar_id_categoria(){
            return $this->id_categoria;
        }
        public function Mostrar_nombre_producto(){
            return $this->nombre_producto;
        }
        public function Mostrar_descripcion(){
            return $this->descripcion;
        }

        /**
         * He aislado la ejecucion de todas las consultas SQL para reduccion de codigo.
         */
        public function ejecuta($sql) {
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            
            $result->execute();
            $conn=null;
        }
        
        public function insert() {
            $sql = "INSERT INTO `producto` (`precio`, `stock`, `imagen`,`id_categoria`,`nombre_producto`,`descripcion`) VALUES (\"".$this->precio."\", \"".$this->stock."\", \"".$this->imagen."\",\"".$this->id_categoria."\",\"".$this->nombre_producto."\",\"".$this->descripcion."\")";
            $this->ejecuta($sql);
        }
        public function delete() {
            $sql = "UPDATE `producto` SET `STOCK` = \"0\" WHERE `producto`.`nombre_producto` = \"".$this->nombre_producto."\"";    
            
            $this->ejecuta($sql);
        }
        public function modify() {                 
            $sql = "UPDATE `producto` SET `stock` = \"$this->stock\", `imagen` = \"".$this->imagen."\", `precio` = \"$this->precio\",  `id_categoria` = \"$this->id_categoria\", `nombre_producto` = \"".$this->nombre_producto."\", `descripcion` = \"".$this->descripcion."\" WHERE `producto`.`id_producto` = \"".$this->id_producto."\"";


            $this->ejecuta($sql);
        }

        /**
         * En el cago de obtener la lista de productos no utilizo la funcion ejecuta() debido a que requiero obtener un
         * array de los resultados, por lo que no es compatible con el resco de consultas.
         */

        public static function getJuegos() {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `producto`";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos;    
        }
        public static function getJuego($producto) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `producto` WHERE ID_PRODUCTO = $producto";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos;    
        }
        public static function getCategoria($categoria) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `categoria` WHERE ID_CATEGORIA = $categoria";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos;    
        }
        public static function AnadirDeseado($usuario,$producto) {
            $conn = new Conexion();            
            $sql = "INSERT INTO `lista_deseos` (`ID_USUARIO`, `ID_PRODUCTO`) VALUES ($usuario,$producto)";
            
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
        }
        public static function EliminarDeseado($usuario,$producto) {
            $conn = new Conexion();            
            $sql = "DELETE FROM `lista_deseos` WHERE `ID_USUARIO`=$usuario AND `ID_PRODUCTO`=$producto";
            
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
             
        }
        public static function getJuegosDeseados($usuario) {            
            $conn = new Conexion(); 
            $sql = "SELECT ID_PRODUCTO FROM `LISTA_DESEOS` WHERE ID_USUARIO = $usuario";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        public static function getJuegosDeseados2($producto) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `producto` WHERE ID_PRODUCTO = $producto[0]";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        public static function getUserInfo($usuario){
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `usuario` WHERE ID_USUARIO = $usuario";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos; 
        }
        public static function UpdateUser($usuario,$nombre,$apellidos,$email,$direccion){
            $sql = "UPDATE `usuario` SET `NOMBRE` = '$nombre', `APELLIDOS`='$apellidos', `EMAIL` = '$email', `DIRECCION`= '$direccion' WHERE `usuario`.`ID_USUARIO` = $usuario";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            
            $result->execute();
            $conn=null;    
        }
        public static function ChangePassword($usuario,$password){
            $sql = "UPDATE `usuario` SET `CONTRASENA` = '$password' WHERE `usuario`.`ID_USUARIO` = $usuario";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;   
        }
        public static function getValoraciones() {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `Valoracion`";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        public static function getCarrito() {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `PEDIDO`";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        public static function BorrarComentario($usuario,$producto,$comentario){
            $conn = new Conexion();            
            $sql = "DELETE FROM `valoracion` WHERE `ID_USUARIO`=$usuario AND `ID_PRODUCTO`=$producto AND `COMENTARIO`=\"".$comentario."\"";
            echo $sql;
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
        }


    }
    ?>