<?php
require_once 'controllers/GeneroController.php';
require_once 'controllers/TipoIdentificacionController.php';

$genero = new GeneroController();
$tipoIdentificacion = new TipoIdentificacion();

$datos = $genero->getAll();
$datosTipIdent = $tipoIdentificacion->getAll();

?>
<!-- Panel Derecho -->
<div class='Contvcc Frm1' style='margin-top: 20px;'>
  <!-- Formulario de Registro -->
  <form action="<?= base_url ?>Usuario/save" class='Contvcc Frm2 Brd15' method="post">
    <h4>Regístrate</h4>

    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido" placeholder="Apellido" required>

    <select name="tipoIdentificacion" style="height: 40px; width: 185px;" required>
      <option value="" disabled selected>Tipo identificación</option>
      <?php while ($tipIdent = $datosTipIdent->fetch_object()): ?>
        <option value="<?= $tipIdent->id_tipo_identificacion ?>"><?= $tipIdent->nombre ?></option>
      <?php endwhile; ?>
    </select>

    <input type="text" name="numIdentificacion" placeholder="Número identificación" required>
    <input type="email" name="email" placeholder="Correo electrónico" required>
    <input type="text" name="telefono" placeholder="Teléfono" required>
    <select name="genero" style="height: 40px; width: 185px;" required>
      <option value="" disabled selected>Género</option>
      <?php while ($gen = $datos->fetch_object()): ?>
        <option value="<?= $gen->id_genero ?>"><?= $gen->nombre ?></option>
      <?php endwhile; ?>
    </select>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="password2" placeholder="Contraseña" required>
    <div class='Conthcj' style='width: 75%; height: 60px;'>
      <input type="submit" value="Registrarse" class="Bt4b">
      <input type="button" value="Cancelar" class="Bt4r" onclick="location.href='<?= base_url ?>'">
    </div>
  </form>
  <!-- End Formulario de Registro -->
</div>
<!-- End Panel Derecho -->
</body>

</html>