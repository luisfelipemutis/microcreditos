<?php
require_once 'models/Prestamo.php';
require_once 'models/producto.php';

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
                $producto = new Producto();
                $producto->updateRentedProduct($prestamo->getIdProducto());

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

    public function getLoansByIdUser()
    {
        if (!isset($_SESSION['identity'])) {
            $_SESSION['msgerror'] = "Debes iniciar sesión.";
            require_once 'views/error.php';
            return;
        }

        $loanModel = new Prestamo();
        $loans = $loanModel->getLoansByIdUser($_SESSION['identity']->id_usuario);

        require_once 'views/prestamos/manageLoans.php';
    }

    public function cancelarPrestamo()
    {
        if (!isset($_SESSION['identity'])) {
            $_SESSION['msgerror'] = "Debes iniciar sesión.";
            require_once 'views/error.php';
            return;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['msgerror'] = "No se especificó el préstamo a cancelar.";
            require_once 'views/error.php';
            return;
        }

        $idPrestamo = $_GET['id'];
        $idUsuario = $_SESSION['identity']->id_usuario;

        $prestamo = new Prestamo();

        $prestamoData = $prestamo->getPrestamoById($idPrestamo);
        if (!$prestamoData) {
            $_SESSION['msgerror'] = "No se encontró el préstamo.";
            require_once 'views/error.php';
            return;
        }

        $idProducto = $prestamoData->id_producto;
        $result = $prestamo->cancelarPrestamo($idPrestamo, $idUsuario);

        if ($result) {
            $producto = new Producto();
            $producto->updateReturnedProduct($idProducto);

            $_SESSION['msgsuccess'] = "Solicitud cancelada correctamente.";
        } else {
            $_SESSION['msgerror'] = "No se pudo cancelar la solicitud.";
        }

        header("Location: " . base_url . "index.php?controller=Prestamo&action=getLoansByIdUser");
    }

    public function marcarComoDevuelto()
    {
        if (!isset($_SESSION['identity'])) {
            $_SESSION['msgerror'] = "Debes iniciar sesión.";
            require_once 'views/error.php';
            return;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['msgerror'] = "No se especificó el préstamo a devolver.";
            require_once 'views/error.php';
            return;
        }

        $idPrestamo = $_GET['id'];
        $idUsuario = $_SESSION['identity']->id_usuario;

        $prestamo = new Prestamo();
        $prestamoData = $prestamo->getPrestamoById($idPrestamo);
        if (!$prestamoData) {
            $_SESSION['msgerror'] = "No se encontró el préstamo.";
            require_once 'views/error.php';
            return;
        }

        $idProducto = $prestamoData->id_producto;
        $result = $prestamo->marcarComoDevuelto($idPrestamo, $idUsuario);

        if ($result) {
            $producto = new Producto();
            $producto->updateReturnedProduct($idProducto);

            $_SESSION['msgsuccess'] = "El préstamo fue marcado como devuelto correctamente.";
        } else {
            $_SESSION['msgerror'] = "No se pudo marcar como devuelto.";
        }

        header("Location: " . base_url . "index.php?controller=Prestamo&action=getLoansByIdUser");
    }
}
?>