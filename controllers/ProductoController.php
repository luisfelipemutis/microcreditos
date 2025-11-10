<?php
  require_once 'models/producto.php';
  class ProductoController{
    
    public function index(){
      $producto = new Producto();
      $productos = $producto->getRandom();
      require_once 'views/productos/aleatorios.php';
    }
  }
?>