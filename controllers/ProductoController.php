<?php
require_once 'models/producto.php';
class ProductoController
{

  public function index()
  {
    $producto = new Producto();
    $productos = $producto->getRandomAll();
    require_once 'views/productos/aleatorios.php';
  }

  public function rent()
  {
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      $producto = new Producto();
      $data = $producto->getProductById($id);

      if ($data && is_object($data)) {
        require_once 'views/productos/rentProduct.php';
      } else {
        $_SESSION['msgerror'] = "Producto no encontrado.";
        require_once 'views/error.php';
      }
    } else {
      $_SESSION['msgerror'] = "No se especificó el producto.";
      require_once 'views/error.php';
    }
  }

}
?>