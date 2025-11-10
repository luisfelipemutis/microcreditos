<!-- Sidebar -->
<aside class='Contvtc Block_aside'>
  <div class='Contvtc' style='width: 260px;'>
    <?php if(!isset($_SESSION['identity'])): ?>
      <!-- Página sin inicio de sesión -->
      <form class='Contvtc Frm260' action="<?=base_url?>usuario/login" method="POST">
        <div class='Conthcl Frm260'>
          <label for="cedula">Cédula</label>
          <input type="text" name='cedula' placeholder='cédula'>
        </div>
        <div class='Conthcl Frm260'>
          <label for="clave">Contraseña</label>
          <input type="password" name='clave' placeholder='contraseña'>
        </div>

        <input class="Bt4b" type="submit" value="Ingresar">
        <br><h7>No estás registrado?</h7>
        <a class="Hovsbr" href="<?=base_url?>usuario/registro">
          <h5>Regístrate</h5>
        </a>
      </form>
      <!-- Fin página sin inicio de sesión -->
    <?php else: ?>
      <!-- Página con inicio de sesión -->
      <br><h4> <?= $_SESSION['identity']->nombres . " " . $_SESSION['identity']->apellidos ?></h4><br>
      <ul>
        <li><a class="Bt2" href="#">Gestionar Cuenta</a></li>
        <li><a class="Bt2" href="#">Gestionar Prestamos</a></li>
        <li><a class="Bt2" href="#">Ver Historial</a></li>
      </ul><br>
      <input type="button" value="Cerrar Sesión" class="Bt4r" 
       onclick="location.href='<?=base_url?>usuario/logout'">
      <!-- Fin página con inicio de sesión -->
    <?php endif; ?>
  </div>

</aside>
<!-- End Sidebar -->
