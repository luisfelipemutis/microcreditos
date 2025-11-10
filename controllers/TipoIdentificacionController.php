<?php
require_once 'models/tipoIdentificacion.php';

class TipoIdentificacionController
{
    public function getAll()
    {
        $tipoIdentificacion = new TipoIdentificacion();
        $tiposIdentificacion = $tipoIdentificacion->getAll();
        return $tiposIdentificacion;
    }
}
?>