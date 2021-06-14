<?php
    /**
     * Pagina inicial cargo la lista de producto en un array 'listado' e inclullo la vista listado, que es donde se mostraran
     * los producto cargados en el array.
     * 
    */

    include ('../modelo/videojuego.php');
    //$listado['producto'] = Producto::getJuegos();
   
    header("Location: ../index.php");
?>