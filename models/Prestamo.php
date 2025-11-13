<?php
require_once 'config/conexion.php';

class Prestamo
{
    private $id_prestamo;
    private $id_usuario_solicitante;
    private $id_producto;
    private $tipo_prestamo;
    private $monto_solicitado;
    private $motivo_solicitud;
    private $fecha_solicitud;
    private $fecha_prestamo;
    private $fecha_devolucion;
    private $id_estado_actual;
    private $id_usuario_aprobador;
    private $fecha_aprobacion;
    private $observaciones_aprobacion;
    private $db;

    public function __construct()
    {
        $this->db = Connection::connect();
    }

    // Getters and Setters

    public function getIdPrestamo()
    {
        return $this->id_prestamo;
    }

    public function setIdPrestamo($id_prestamo)
    {
        $this->id_prestamo = $id_prestamo;
    }

    public function getIdUsuarioSolicitante()
    {
        return $this->id_usuario_solicitante;
    }

    public function setIdUsuarioSolicitante($id_usuario_solicitante)
    {
        $this->id_usuario_solicitante = $id_usuario_solicitante;
    }

    public function getIdProducto()
    {
        return $this->id_producto;
    }

    public function setIdProducto($id_producto)
    {
        $this->id_producto = $id_producto;
    }

    public function getTipoPrestamo()
    {
        return $this->tipo_prestamo;
    }

    public function setTipoPrestamo($tipo_prestamo)
    {
        $this->tipo_prestamo = $tipo_prestamo;
    }

    public function getMontoSolicitado()
    {
        return $this->monto_solicitado;
    }

    public function getMotivoSolicitud()
    {
        return $this->motivo_solicitud;
    }

    public function setMotivoSolicitud($motivoSolicitud)
    {
        $this->motivo_solicitud = $motivoSolicitud;
    }

    public function setMotivoSolicitado($motivoSolicitado)
    {
        $this->motivo_solicitado = $motivoSolicitado;
    }

    public function getFechaSolicitud()
    {
        return $this->fecha_solicitud;
    }

    public function setFechaSolicitud($fecha_solicitud)
    {
        $this->fecha_solicitud = $fecha_solicitud;
    }

    public function getFechaPrestamo()
    {
        return $this->fecha_prestamo;
    }

    public function setFechaPrestamo($fecha_prestamo)
    {
        $this->fecha_prestamo = $fecha_prestamo;
    }

    public function getFechaDevolucion()
    {
        return $this->fecha_devolucion;
    }

    public function setFechaDevolucion($fecha_devolucion)
    {
        $this->fecha_devolucion = $fecha_devolucion;
    }

    public function getIdEstadoActual()
    {
        return $this->id_estado_actual;
    }

    public function setIdEstadoActual($id_estado_actual)
    {
        $this->id_estado_actual = $id_estado_actual;
    }

    public function getIdUsuarioAprobador()
    {
        return $this->id_usuario_aprobador;
    }

    public function setIdUsuarioAprobador($id_usuario_aprobador)
    {
        $this->id_usuario_aprobador = $id_usuario_aprobador;
    }

    public function getFechaAprobacion()
    {
        return $this->fecha_aprobacion;
    }

    public function setFechaAprobacion($fecha_aprobacion)
    {
        $this->fecha_aprobacion = $fecha_aprobacion;
    }

    public function getObservacionesAprobacion()
    {
        return $this->observaciones_aprobacion;
    }

    public function setObservacionesAprobacion($observacionesAprobacion)
    {
        $this->observaciones_aprobacion = $observacionesAprobacion;
    }

    // Methods
    public function solicitarPrestamo()
    {
        $result = false;

        try {
            $sql = "INSERT INTO prestamos (
            id_usuario_solicitante,
            id_producto,
            tipo_prestamo,
            monto_solicitado,
            motivo_solicitud,
            fecha_solicitud,
            fecha_devolucion,
            id_estado_actual
        ) VALUES (
            '{$this->getIdUsuarioSolicitante()}',
            '{$this->getIdProducto()}',
            1, -- Tipo préstamo (producto)
            1, -- Monto por defecto
            '{$this->getMotivoSolicitud()}',
            '{$this->getFechaSolicitud()}',
            '{$this->getFechaDevolucion()}',
            1  -- Estado inicial: Solicitado
        )";

            $save = $this->db->query($sql);

            if ($save) {
                $result = true;
            }
        } catch (Exception $e) {
            error_log("Excepción en solicitarPrestamo(): " . $e->getMessage());
        }

        return $result;
    }
}
?>