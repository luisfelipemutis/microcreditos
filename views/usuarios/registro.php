<?php
require_once 'controllers/GeneroController.php';
require_once 'controllers/TipoIdentificacionController.php';

$genero = new GeneroController();
$tipoIdentificacion = new TipoIdentificacion();

$datos = $genero->getAll();
$datosTipIdent = $tipoIdentificacion->getAll();
?>

<!-- Contenedor centrado -->
<div class="registro-container">
  <form action="<?= base_url ?>Usuario/save" method="post" class="registro-form">
    <h2>Crear una cuenta</h2>
    <p class="registro-subtitle">Completa el formulario para registrarte</p>

    <div class="registro-grid">
      <input type="text" name="nombre" placeholder="Nombre" required>
      <input type="text" name="apellido" placeholder="Apellido" required>

      <select name="tipoIdentificacion" required>
        <option value="" disabled selected>Tipo de identificación</option>
        <?php while ($tipIdent = $datosTipIdent->fetch_object()): ?>
          <option value="<?= $tipIdent->id_tipo_identificacion ?>"><?= $tipIdent->nombre ?></option>
        <?php endwhile; ?>
      </select>

      <input type="text" name="numIdentificacion" placeholder="Número de identificación" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <input type="text" name="telefono" placeholder="Teléfono" required>

      <select name="genero" required>
        <option value="" disabled selected>Género</option>
        <?php while ($gen = $datos->fetch_object()): ?>
          <option value="<?= $gen->id_genero ?>"><?= $gen->nombre ?></option>
        <?php endwhile; ?>
      </select>

      <input type="password" name="password" placeholder="Contraseña" required>
      <input type="password" name="password2" placeholder="Confirmar contraseña" required>
    </div>

    <div class="registro-buttons">
      <input type="submit" value="Registrarse" class="Bt4b">
      <input type="button" value="Cancelar" class="Bt4r" onclick="location.href='<?= base_url ?>'">
    </div>
  </form>
</div>