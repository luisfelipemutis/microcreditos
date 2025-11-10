<?php
require_once 'config/conexion.php';

class Usuario
{
  private $id_usuario;
  private $nombres;
  private $apellidos;
  private $id_tipo_identificacion;
  private $identificacion;
  private $id_genero;
  private $email;
  private $telefono;
  private $id_tipo_usuario;
  private $password_hash;
  private $activo;
  private $fecha_registro;
  private $db;

  // Constructor
  public function __construct()
  {
    $this->db = Connection::connect();
  }

  // Getters and Setters

  public function getIdUsuario()
  {
    return $this->id_usuario;
  }

  public function setIdUsuario($id_usuario)
  {
    $this->id_usuario = $id_usuario;
  }

  public function getNombres()
  {
    return $this->nombres;
  }

  public function setNombres($nombres)
  {
    $this->nombres = $nombres;
  }

  public function getApellidos()
  {
    return $this->apellidos;
  }

  public function setApellidos($apellidos)
  {
    $this->apellidos = $apellidos;
  }

  public function getIdTipoIdentificacion()
  {
    return $this->id_tipo_identificacion;
  }

  public function setIdTipoIdentificacion($id_tipo_identificacion)
  {
    $this->id_tipo_identificacion = $id_tipo_identificacion;
  }

  public function getIdentificacion()
  {
    return $this->identificacion;
  }

  function setIdentificacion($identificacion)
  {
    $this->identificacion = $identificacion;
  }

  function getIdGenero()
  {
    return $this->id_genero;
  }

  function setIdGenero($id_genero)
  {
    $this->id_genero = $id_genero;
  }

  function getEmail()
  {
    return $this->email;
  }

  function setEmail($email)
  {
    $this->email = $this->db->real_escape_string($email);
  }

  function getTelefono()
  {
    return $this->telefono;
  }

  function setTelefono($telefono)
  {
    $this->telefono = $this->db->real_escape_string($telefono);
  }

  function getIdTipoUsuario()
  {
    return $this->id_tipo_usuario;
  }

  function setIdTipoUsuario($id_tipo_usuario)
  {
    $this->id_tipo_usuario = $id_tipo_usuario;
  }

  function getPasswordHash()
  {
    return password_hash($this->password_hash, PASSWORD_BCRYPT, ['cost' => 4]);
  }

  function setPasswordHash($password_hash)
  {
    $this->password_hash = $password_hash; // Hashing is done in the getter
  }

  function getActivo()
  {
    return $this->activo;
  }

  function setActivo($activo)
  {
    $this->activo = $activo;
  }

  function getFechaRegistro()
  {
    return $this->fecha_registro;
  }

  function setFechaRegistro($fecha_registro)
  {
    $this->fecha_registro = $fecha_registro;
  }

  // Methods
  public function save()
  {
    $result = false;
    try {


      $sql = "INSERT INTO usuarios (
            nombres, 
            apellidos, 
            id_tipo_identificacion, 
            identificacion, 
            id_genero, 
            email, 
            telefono, 
            id_tipo_usuario, 
            password_hash, 
            activo
        ) VALUES (
            '{$this->getNombres()}',
            '{$this->getApellidos()}',
            {$this->getIdTipoIdentificacion()},
            '{$this->getIdentificacion()}',
            {$this->getIdGenero()},
            '{$this->getEmail()}',
            '{$this->getTelefono()}',
            1,  # ESTUDIANTE
            '{$this->getPasswordHash()}',
            1 # activo
        )";

      $save = $this->db->query($sql);
      if ($save) {
        $result = true;
      }
      return $result;
    } catch (Exception $e) {
      error_log("EXCEPCIÓN en save(): " . $e->getMessage());
      return $result;
    }
  }

  public function login()
  {
    $result = false;
    $id = $this->identificacion;
    $password = $this->password_hash;

    // Check if user exists
    $sql = "SELECT * FROM usuarios WHERE identificacion = '$id'";
    $login = $this->db->query($sql);

    if ($login && $login->num_rows == 1) {
      $usuario = $login->fetch_object();

      // Verify password
      $verify = password_verify($password, $usuario->password_hash);
      if ($verify) {
        $result = $usuario;
      }
    }
    return $result;
  }
}
?>