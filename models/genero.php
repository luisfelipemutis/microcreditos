<?php
require_once 'config/conexion.php';

class Genero
{
  private $id_genero;
  private $codigo;
  private $nombre;
  private $orden;
  private $db;

  public function __construct()
  {
    $this->db = Connection::connect();
  }

  function getIdGnero()
  {
    return $this->id_genero;
  }

  function getCodigo()
  {
    return $this->codigo;
  }

  function getNombre()
  {
    return $this->nombre;
  }

  function getOrden()
  {
    return $this->orden;
  }

  // Setters
  function setIdGenero($id_genero)
  {
    $this->id_genero = $id_genero;
  }

  function setCodigo($codigo)
  {
    $this->codigo = $this->db->real_escape_string($codigo);
  }

  function setNombre($nombre)
  {
    $this->nombre = $this->db->real_escape_string($nombre);
  }

  function setOrden($orden)
  {
    $this->orden = $orden;
  }

  // CRUD Methods
  public function getAll()
  {
    $result = false;
    $sql = "SELECT * FROM generos ORDER BY id_genero ASC";
    $datos = $this->db->query($sql);
    if ($datos && $datos->num_rows > 0) {
      $result = $datos;
    }
    return $result;
  }
}