<!-- Sidebar -->
<aside class="sidebar">
  <div class="sidebar-content">

    <?php if (!isset($_SESSION['identity'])): ?>
      <!-- Vista: No logueado -->
      <div class="sidebar-header">
        <h3>Bienvenido</h3>
        <p>Inicia sesión para continuar</p>
      </div>

      <form class="sidebar-form" action="<?= base_url ?>usuario/login" method="POST">
        <label for="cedula">Cédula</label>
        <input type="text" name="cedula" placeholder="Cédula" required>

        <label for="clave">Contraseña</label>
        <input type="password" name="clave" placeholder="Contraseña" required>

        <input class="btn btn-primary" type="submit" value="Ingresar">
        <p class="register-text">¿No estás registrado?</p>
        <a class="link" href="<?= base_url ?>usuario/registro">Regístrate aquí</a>
      </form>

    <?php else: ?>
      <!-- Vista: Logueado -->
      <div class="sidebar-header">
        <img src="<?= base_url ?>assets/images/iconos/avatar_default.png" alt="Avatar" class="avatar">
        <h3><?= $_SESSION['identity']->nombres . " " . $_SESSION['identity']->apellidos ?></h3>
        <p>Usuario activo</p>
      </div>

      <ul class="sidebar-menu">
        <li>
          <a href="<?= base_url ?>index.php?view=updateUser" class="btn btn-secondary">Gestionar Cuenta</a>
        </li>
        <li><a href="#" class="btn btn-secondary">Gestionar Préstamos</a></li>
        <!-- <li><a href="#" class="btn btn-secondary">Ver Historial</a></li> -->
      </ul>

      <button class="btn btn-danger" onclick="location.href='<?= base_url ?>usuario/logout'">Cerrar Sesión</button>
    <?php endif; ?>

  </div>
</aside>
<!-- End Sidebar -->