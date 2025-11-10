<?php
require_once 'models/usuario.php';
class UsuarioController
{

  public function index()
  {
    // Lógica para listar usuarios
    echo "<h3>Hola mundo</h3>";
  }

  public function registro()
  {
    require_once 'views/usuarios/registro.php';
  }

  public function save()
  {
    if (isset($_POST)) {
      $clave = $_POST['password'];
      $clave2 = $_POST['password2'];
      if ($clave != $clave2) {
        $_SESSION['msgerror'] = "Las contraseñas no coinciden";
        $_SESSION['view'] = "usuario/registro";
        require_once 'views/error.php';
        return;
      }
      $usuario = new Usuario();
      $usuario->setNombres($_POST['nombre']);
      $usuario->setApellidos($_POST['apellido']);
      $usuario->setIdTipoIdentificacion(id_tipo_identificacion: $_POST['tipoIdentificacion']);
      $usuario->setIdentificacion($_POST['numIdentificacion']);
      $usuario->setIdGenero($_POST['genero']);
      $usuario->setEmail($_POST['email']);
      $usuario->setTelefono($_POST['telefono']);
      $usuario->setPasswordHash($_POST['password']);

      $save = $usuario->save();
      if ($save) {
        $_SESSION['msgsuccess'] = "Registro completado con exito!";
        require_once 'views/success.php';
      } else {
        $_SESSION['msgerror'] = "Error en el registro de los datos!!";
        require_once 'views/error.php';
      }
    } else {
      $_SESSION['msgerror'] = "No existen datos de entrada";
      require_once 'views/error.php';
    }
  }

  public function login()
  {
    $valido = false;
    if (isset($_POST)) {
      $usuario = new Usuario(); //debo incluir el modelo
      $usuario->setIdentificacion($_POST['cedula']);
      $usuario->setPasswordHash($_POST['clave']);
      $datos = $usuario->login();
      if ($datos && is_object($datos)) {
        $valido = true;
        $_SESSION['identity'] = $datos;
      } else {
        $_SESSION['msgerror'] = "Identificación o contraseña incorrecta";
        require_once 'views/error.php';
      }
      if ($valido) {
        header("Location:" . base_url);
      }
    }
  }

  public function logout()
  {
    if (isset($_SESSION['identity'])) {
      unset($_SESSION['identity']);
    }
    header("Location:" . base_url);
  }
}
?>