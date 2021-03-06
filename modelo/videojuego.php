<?php

    require_once 'conexion.php';
    
    /**
     * 
     * Objeto producto.
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
         * He aislado la ejecucion de todas las consultas SQL de producto para reduccion de codigo.
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
         * En el caso de obtener la lista de productos no utilizo la funcion ejecuta() debido a que requiero obtener un
         * array de los resultados, por lo que no es compatible con el resto de consultas.
         */
        //Me devuelve todos los juegos
        public static function getJuegos() {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `producto`";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos;    
        }
        //Me duevuelve un juego dado el id de este
        public static function getJuego($producto) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `producto` WHERE ID_PRODUCTO = $producto";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos;    
        }
        //Devuelve los datos de categoria a traves del ID
        public static function getCategoria($categoria) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `categoria` WHERE ID_CATEGORIA = $categoria";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos;    
        }
        //A??ade a deseados un producto si no esta ya en la lista del usuario
        public static function AnadirDeseado($usuario,$producto) {
            $conn = new Conexion();
            $sql = "SELECT * FROM `lista_deseos` WHERE ID_USUARIO = $usuario AND ID_PRODUCTO = $producto";
            $result = $conn->prepare($sql); 
            $result->execute();
            $results = $result->fetch(PDO::FETCH_ASSOC); 
            if(empty($results)){
                $sql = "INSERT INTO `lista_deseos` (`ID_USUARIO`, `ID_PRODUCTO`) VALUES ($usuario,$producto)";
            
                $result = $conn->prepare($sql); 
                $result->execute();
            }        
            $conn=null;
        }
        //Elimina un producto de la lista de deseados del usuario 
        public static function EliminarDeseado($usuario,$producto) {
            $conn = new Conexion();            
            $sql = "DELETE FROM `lista_deseos` WHERE `ID_USUARIO`=$usuario AND `ID_PRODUCTO`=$producto";
            
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
             
        }
        //Devuelve todos los ID_productos de la lista de deseados del usuario 
        public static function getJuegosDeseados($usuario) {            
            $conn = new Conexion(); 
            $sql = "SELECT ID_PRODUCTO FROM `LISTA_DESEOS` WHERE ID_USUARIO = $usuario";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        //Me duevuelve un juego dado el id de este
        public static function getJuegosDeseados2($producto) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `producto` WHERE ID_PRODUCTO = $producto";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        //Obtiene toda la informacion de un usuario
        public static function getUserInfo($usuario){
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `usuario` WHERE ID_USUARIO = $usuario";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            return $productos; 
        }
        //Actualiza un usuario con los datos proporcionados
        public static function UpdateUser($usuario,$nombre,$apellidos,$email,$direccion){
            $sql = "UPDATE `usuario` SET `NOMBRE` = '$nombre', `APELLIDOS`='$apellidos', `EMAIL` = '$email', `DIRECCION`= '$direccion' WHERE `usuario`.`ID_USUARIO` = $usuario";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            
            $result->execute();
            $conn=null;    
        }
        //Cambia la contrase??a de un usuario
        public static function ChangePassword($usuario,$password){
            $sql = "UPDATE `usuario` SET `CONTRASENA` = '$password' WHERE `usuario`.`ID_USUARIO` = $usuario";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;   
        }
        //Obtiene todas las valoraciones
        public static function getValoraciones() {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `Valoracion`";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        //Inserta un valoraciones de un usuario a un juego en la BBDD
        public static function AnadirValoracion($usuario,$producto,$puntuacion,$comentario){
            $conn = new Conexion();            
            $sql = "INSERT INTO `valoracion` (`ID_USUARIO`, `ID_PRODUCTO`,`PUNTUACION`,`COMENTARIO`) VALUES ($usuario,$producto,$puntuacion,'$comentario')";
            
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
        }
        //A??ade un pedido a la BBDD de parte del usuario
        public static function Comprar($usuario){
            $conn = new Conexion();
            $fechaformato = date('d/m/Y');  
            $sql = "INSERT INTO `pedido` (`COMPRADO`,`FECHA`,`ID_USUARIO`) VALUES (0,'$fechaformato',$usuario)";
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
        }
        //Finaliza la compra, dando el pedido por vendido
        public static function ComprarPedido($pedido){
            $sql = "UPDATE `pedido` SET `COMPRADO` = 1 WHERE `ID_PEDIDO` = $pedido";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;   
        }
        //Boolean, comprueba si ya existe un pedido en activo para el usuario
        public static function existePedido($usuario){
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `pedido` WHERE `ID_USUARIO` = $usuario AND `COMPRADO`= 0 ";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;  
        }
        //Permite devolver un juego ya comprado por un usuario
        public static function DevolverJuego($pedido,$producto){
            $conn = new Conexion(); 
            $sql = "SELECT `FECHA` FROM `pedido` WHERE `ID_PEDIDO` = $pedido ";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);

            //Obtenemos fechas actuales y  de adquisicion para comprobar si han pasado 15 dias 
            $fechaActual = date('d/m/Y');
            $fechaAdquisicion = $productos['FECHA'];
            echo "Fecha del pedido ".$fechaAdquisicion."<br>";

            //sumamos 15 dias a la fecha de adquisicion
            $aux = date_create_from_format('d/m/Y', $fechaAdquisicion);
            date_add($aux, date_interval_create_from_date_string("15 days"));
            $FechaFinalDevolucion = date_format($aux,"d/m/Y");
            echo "Fecha limite de devolucion ".$FechaFinalDevolucion."<br>";

            //transformamos el string a fecha con el mismo formato
            $aux1 = date_create_from_format('d/m/Y', $fechaActual);
            $FechaFinalHoy = date_format($aux1,"d/m/Y");
            echo "Fecha de hoy ".$FechaFinalHoy."<br><br>";

            $FechaFinalDevolucion1 = date_create_from_format('d/m/Y',strval($FechaFinalDevolucion));
            $hoy = date_create_from_format('d/m/Y',strval($FechaFinalHoy));
            
            //permitimos devolver el objeto si esta dentro de la fecha de devolucion
            if ($FechaFinalDevolucion1 > $hoy) {
                echo "Producto devuelto con exito"."<br>";
                printf('%s > %s', $FechaFinalDevolucion1->format('d/m/Y'), $hoy->format('d/m/Y'));
                $sql = "UPDATE `detalle_pedido` SET `DEVUELTO` = 'Y' WHERE `ID_PEDIDO` = $pedido AND `ID_PRODUCTO`=$producto ";
                $result = $conn->prepare($sql); 
                $result->execute();
            } else {
                //mostramos mensaje de error si la fecha de devolucion ha caducado
                echo "Fecha limite de devolucion sobrepasada"."<br>";
                printf('%s < %s', $FechaFinalDevolucion1->format('d/m/Y'), $hoy->format('d/m/Y'));
            }
            $conn=null;
        }
        //Obtiene el historial de compra de un usuario
        public static function getHistorialCompra($usuario){
            $conn = new Conexion(); 
            $sql = "SELECT `ID_PEDIDO`  FROM `pedido` WHERE `ID_USUARIO` = $usuario AND `COMPRADO`= 1 ";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;  
        }
        //elimina un producto del carrito
        public static function BorrarPedido($pedido,$producto) {
            $conn = new Conexion();            
            $sql = "DELETE FROM `detalle_pedido` WHERE `ID_PEDIDO`=$pedido AND `ID_PRODUCTO`=$producto";
            $result = $conn->prepare($sql); 
            $result->execute();
            $numerofilas = $result->rowCount();
            $conn=null;
            return $numerofilas;
             
        }
        //A??ade el producto al pedido
        public static function ComprarDetalle($pedido,$producto){
            $conn = new Conexion();   
            $sql = "INSERT INTO `detalle_pedido` (`CANTIDAD`,`DEVUELTO`,`ID_PEDIDO`,`ID_PRODUCTO`) VALUES (1,'N',$pedido,$producto)";
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
        }
        //reduce el stock del producto comprado
        public static function RecibeCompra($producto){
            $sql = "UPDATE `producto` SET `STOCK` = `STOCK`-1 WHERE `ID_PRODUCTO` = $producto";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;   
        }
        //aumenta el stock del producto comprado
        public static function DevuelveCompra($producto,$cantidad){
            $sql = "UPDATE `producto` SET `STOCK` = `STOCK`+ $cantidad WHERE `ID_PRODUCTO` = $producto";
            $conn = new Conexion();
            $result = $conn->prepare($sql);
            $result->execute();
            $conn=null;   
        }
        //Obtiene los pedidos del carrito del usuario
        public static function getCarrito($usuario) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `pedido` WHERE `ID_USUARIO`=$usuario AND `COMPRADO` = 0 ";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetch(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        //Obtiene los productos del pedido del carrito del usuario
        public static function getProductosCarrito($pedido) {            
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `detalle_pedido` WHERE `ID_PEDIDO`=$pedido AND `DEVUELTO`='N' ";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        //Borra un comentario de la base de datos
        public static function BorrarComentario($usuario,$producto,$comentario){
            $conn = new Conexion();            
            $sql = "DELETE FROM `valoracion` WHERE `ID_USUARIO`=$usuario AND `ID_PRODUCTO`=$producto AND `COMENTARIO`=\"".$comentario."\"";
            $result = $conn->prepare($sql); 
            $result->execute();
            $conn=null;
        }
        //Envia un email con los datos de facturacion de la compra (NO ENVIA EMAIL)
        public static function EnviarEmail($email,$productos){
            $conn = new Conexion();
            $mensaje = "";
            foreach ($productos as $producto) {
                $productoId = $producto['ID_PRODUCTO'];
                $sql = "SELECT * FROM `producto` WHERE `ID_PRODUCTO`=$productoId";
                $result = $conn->prepare($sql); 
                $result->execute();
                $productos = $result->fetch(PDO::FETCH_ASSOC);
                $mensaje =$mensaje."<br>".$productos['NOMBRE_PRODUCTO']." ".$productos['PRECIO']."???";
            }
            echo $mensaje;
            mail($email, 'Usted ha comprado los siguientes productos ', $mensaje);
        }
        //Obtiene un listado de todos los usuarios
        public static function getAllUsers(){
            $conn = new Conexion(); 
            $sql = "SELECT * FROM `usuario` WHERE `ADMINISTRADOR`=0 ";
            $result = $conn->prepare($sql); 
            $result->execute();
            $productos = $result->fetchAll(PDO::FETCH_ASSOC);
            $conn=null;
            
            return $productos;    
        }
        //Elimina un usuario en cascada, excepto si ha realizado una compra final
        public static function BorrarUser($user){
            $conn = new Conexion();
            $sql = "SELECT ID_PEDIDO FROM `pedido` WHERE `ID_USUARIO`=$user AND `COMPRADO`= 0";
            $result = $conn->prepare($sql); 
            $result->execute();
            $pedidosId = $result->fetchAll(PDO::FETCH_ASSOC);
            print_r($pedidosId);
            if($pedidosId){
                foreach ($pedidosId as $Id){
                    $aux = $Id['ID_PEDIDO'];
                    $sql = "DELETE FROM `detalle_pedido` WHERE `ID_PEDIDO`=$aux ";
                    $result = $conn->prepare($sql); 
                    $result->execute();
                    print_r($Id);
                    
                }
            }
            $sql = "DELETE FROM `pedido` WHERE `ID_USUARIO`=$user AND `COMPRADO`= 0 ";
            $result = $conn->prepare($sql); 
            $result->execute();
            
            
            $sql = "DELETE FROM `lista_deseos` WHERE `ID_USUARIO`=$user ";
            $result = $conn->prepare($sql); 
            $result->execute();
            

            $sql = "DELETE FROM `valoracion` WHERE `ID_USUARIO`=$user ";
            $result = $conn->prepare($sql); 
            $result->execute();
            
                           
            $sql = "DELETE FROM `usuario` WHERE `ID_USUARIO`=$user ";
            $result = $conn->prepare($sql); 
            $result->execute();
            
            $conn=null;
        }
    }
