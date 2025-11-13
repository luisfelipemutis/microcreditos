<?php
require_once 'config/conexion.php';

class Producto
{
  private $id_producto;
  private $nombre;
  private $descripcion;
  private $id_categoria;
  private $cantidad_disponible;
  private $valor_aproximado;
  private $condiciones_uso;
  private $requiere_aprobacion;
  private $activo;
  private $fecha_creacion;
  private $db;

  public function __construct()
  {
    $this->db = Connection::connect();
  }
  // Getters and Setters
  function getIdProducto()
  {
    return $this->id_producto;
  }

  function setIdProducto($id_producto)
  {
    $this->id_producto = $id_producto;
  }

  function getNombre()
  {
    return $this->nombre;
  }

  function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  function getDescripcion()
  {
    return $this->descripcion;
  }

  function setDescripcion($descripcion)
  {
    $this->descripcion = $descripcion;
  }

  function getIdCategoria()
  {
    return $this->id_categoria;
  }

  function setIdCategoria($id_categoria)
  {
    $this->id_categoria = $id_categoria;
  }

  function getCantidadDisponible()
  {
    return $this->cantidad_disponible;
  }

  function setCantidadDisponible($cantidad_disponible)
  {
    $this->cantidad_disponible = $cantidad_disponible;
  }

  function getValorAproximado()
  {
    return $this->valor_aproximado;
  }

  function setValorAproximado($valor_aproximado)
  {
    $this->valor_aproximado = $valor_aproximado;
  }

  function getCondicionesUso()
  {
    return $this->condiciones_uso;
  }

  function setCondicionesUso($condiciones_uso)
  {
    $this->condiciones_uso = $condiciones_uso;
  }

  function getRequiereAprobacion()
  {
    return $this->requiere_aprobacion;
  }

  function setRequiereAprobacion($requiere_aprobacion)
  {
    $this->requiere_aprobacion = $requiere_aprobacion;
  }

  function getActivo()
  {
    return $this->activo;
  }

  function setActivo($activo)
  {
    $this->activo = $activo;
  }

  function getFechaCreacion()
  {
    return $this->fecha_creacion;
  }
  function setFechaCreacion($fecha_creacion)
  {
    $this->fecha_creacion = $fecha_creacion;
  }

  // Methods
  public function getRandomAll()
  {
    $sql = "SELECT DISTINCT p.*, ip.url_imagen
          FROM productos AS p
          INNER JOIN imagenes_producto AS ip 
          ON p.id_producto = ip.id_producto
          WHERE p.activo = 1
          ORDER BY RAND()";

    $datos = $this->db->query($sql);
    return ($datos && $datos->num_rows > 0) ? $datos : false;
  }

  public function getProductById($id)
  {
    $result = false;
    try {
      $sql = "SELECT p.*, ip.url_imagen FROM productos p INNER JOIN imagenes_producto ip
      ON p.id_producto = ip.id_producto WHERE p.id_producto = '{$id}' LIMIT 1";
      $product = $this->db->query($sql);
      if ($product && $product->num_rows == 1) {
        $result = $product->fetch_object();
      }
    } catch (Exception $e) {
      error_log("Excepción en update(): " . $e->getMessage());
    }
    return $result;
  }

  public function updateRentedProduct($id)
  {
    $result = false;
    try {
      $sql = "UPDATE productos 
                SET cantidad_disponible = cantidad_disponible - 1 
                WHERE id_producto = '{$id}' AND cantidad_disponible > 0"; // previene negativos

      $update = $this->db->query($sql);

      if ($update && $this->db->affected_rows === 1) {
        $result = true;
      }
    } catch (Exception $e) {
      error_log("Excepción en updateRentedProduct(): " . $e->getMessage());
    }

    return $result;
  }
}
?>