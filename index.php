<?php
if (session_status() === PHP_SESSION_NONE)
  session_start();

require_once 'config/parameters.php';
require_once 'autoload.php';
require_once 'views/header.php';
?>

<div class="layout"> <!-- Contenedor principal entre header y footer -->
  <div class="Contptl">
    <!-- SIDEBAR -->
    <aside class="Block_aside">
      <?php require_once 'views/sidebar.php'; ?>
    </aside>

    <!-- MAIN: aquí se cargan las vistas dinámicas -->
    <main id="contenido-principal" class="main-content">
      <?php
      // Función de error
      function show_error()
      {
        $_SESSION['msgerror'] = 'Página no encontrada';
        require_once 'views/error.php';
      }

      // Verificamos si se solicita una vista estática (Sobre Nosotros o Contacto)
      if (isset($_GET['view'])) {
        $view = $_GET['view'];

        switch ($view) {
          case 'sobreNosotros':
            require_once 'views/sobreNosotros/aboutUs.php';
            break;
          case 'contacto':
            require_once 'views/sobreNosotros/contact.php';
            break;
          case 'inicio':
            require_once 'views/inicio.php';
            break;
          case 'updateUser':
            require_once 'views/usuarios/updateUser.php';
            break;
          case 'rentProduct':
            require_once 'views/productos/rentProduct.php';
            break;
          case 'manageLoans':
            require_once 'views/prestamos/manageLoans.php';
            break;
          default:
            show_error();
            break;
        }
      } else {
        // --- Lógica del front controller (controladores dinámicos) ---
        if (isset($_GET['controller'])) {
          $controller = $_GET['controller'] . 'Controller';
        } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
          $controller = controller_default;
        } else {
          show_error();
          exit();
        }

        if (class_exists($controller)) {
          $controlador = new $controller();

          if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
            $action = $_GET['action'];
            $controlador->$action();
          } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
            $action_default = action_default;
            $controlador->$action_default();
          } else {
            show_error();
          }
        } else {
          show_error();
        }
      }
      ?>
    </main>
  </div> <!-- /.Contptl -->
</div> <!-- /.layout -->

<?php
// Se incluye el footer para toda la página
require_once 'views/footer.php';
?>