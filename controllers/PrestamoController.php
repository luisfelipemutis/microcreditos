<?php
require_once 'models/Prestamo.php';

class PrestamoController
{

    public function solicitar()
    {
        if (isset($_POST)) {
            $prestamo = new Prestamo();
            $prestamo->setIdUsuarioSolicitante($_SESSION['identity']->id_usuario);

            if (isset($_POST['id_producto'])) {
                $prestamo->setIdProducto($_POST['id_producto']);
            } else {
                $_SESSION['msgerror'] = "No se especificó el producto a alquilar.";
                require_once 'views/error.php';
                exit;
            }

            $prestamo->setMotivoSolicitud($_POST['motivo']);
            $fechaActual = new DateTime('now', new DateTimeZone('America/Bogota'));
            $prestamo->setFechaSolicitud($fechaActual->format('Y-m-d H:i:s'));

            $fechaDevolucion = DateTime::createFromFormat('Y-m-d', $_POST['fecha_devolucion']);
            if ($fechaDevolucion) {
                $prestamo->setFechaDevolucion($fechaDevolucion->format('Y-m-d'));
            } else {
                $_SESSION['msgerror'] = "Fecha de devolución inválida.";
                require_once 'views/error.php';
                exit;
            }

            $resultSol = $prestamo->solicitarPrestamo();

            if ($resultSol) {
                $_SESSION['msgsuccess'] = "Solicitud creada con éxito.";
                require_once 'views/success.php';
            } else {
                $_SESSION['msgerror'] = "Error al crear la solicitud.";
                require_once 'views/error.php';
            }

        } else {
            $_SESSION['msgerror'] = "No existen datos de entrada.";
            require_once 'views/error.php';
        }
    }

}
?>