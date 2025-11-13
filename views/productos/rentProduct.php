<?php
if (!isset($_SESSION['identity'])) {
    echo "<p>No tienes acceso a esta sección.</p>";
    exit;
}

$user = $_SESSION['identity'];
?>

<?php if (!isset($data)): ?>
    <p>No se ha encontrado información del producto.</p>
    <?php exit; ?>
<?php endif; ?>

<div class="rent-container">
    <div class="rent-producto">
        <img src="<?= base_url ?>assets/images/productos/<?= $data->url_imagen ?>" alt="<?= $data->nombre ?>">
        <div class="rent-info">
            <h2><?= $data->nombre ?></h2>
            <p><strong>Descripción:</strong> <?= $data->descripcion ?></p>
            <p><strong>Condiciones de uso:</strong> <?= $data->condiciones_uso ?></p>
            <p><strong>Cantidad disponible:</strong> <?= $data->cantidad_disponible ?></p>
            <p><strong>Requiere aprobación:</strong> <?= $data->requiere_aprobacion ? 'Sí' : 'No' ?></p>
        </div>
    </div>

    <form action="<?= base_url ?>Prestamo/solicitar" method="POST" class="rent-form">
        <input type="hidden" name="id_producto" value="<?= $data->id_producto ?>">

        <label for="fecha_devolucion">Fecha de devolución:</label>
        <input type="date" name="fecha_devolucion" required>

        <label for="motivo">Motivo de la solicitud:</label>
        <textarea name="motivo" rows="4" placeholder="Describe el propósito del préstamo..." required></textarea>

        <div class="rent-buttons">
            <input type="submit" value="Enviar solicitud" class="Bt4b">
            <input type="button" value="Cancelar" class="Bt4r" onclick="location.href='<?= base_url ?>'">
        </div>
    </form>
</div>