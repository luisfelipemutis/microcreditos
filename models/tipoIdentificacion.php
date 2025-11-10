<?php
require_once 'config/conexion.php';

class TipoIdentificacion
{
    public $id_tipo_identificacion;
    public $codigo;
    public $nombre;
    public $activo;
    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    function getIdTipoIdentificacion()
    {
        return $this->id_tipo_identificacion;
    }

    function setIdTipoIdentificacion($id_tipo_identificacion)
    {
        $this->id_tipo_identificacion = $id_tipo_identificacion;
    }

    function getCodigo()
    {
        return $this->codigo;
    }
    function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    function getNombre()
    {
        return $this->nombre;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    // CRUD Methods
    public function getAll()
    {
        $result = false;
        $sql = 'SELECT * FROM tipos_identificacion ORDER BY id_tipo_identificacion ASC';
        $datos = $this->db->query($sql);
        if ($datos && $datos->num_rows > 0) {
            $result = $datos;
        }
        return $result;
    }
}