<div class="productos-container">
  <?php while ($data = $productos->fetch_object()): ?>
    <div class="producto-card">
      <img src="<?= base_url ?>assets/images/productos/<?= $data->url_imagen ?>" alt="<?= $data->nombre ?>">

      <div class="producto-info">
        <h3><?= $data->nombre ?></h3>
        <p class="descripcion"><?= $data->descripcion ?></p>
        <p class="condiciones"><strong>Condiciones:</strong> <?= $data->condiciones_uso ?></p>
        <p class="cantidad">
          <strong>Disponibles:</strong> <?= $data->cantidad_disponible ?>
        </p>

        <?php if ($data->cantidad_disponible > 0): ?>
          <a href="<?= base_url ?>Producto/rent&id=<?= $data->id_producto ?>" class="btn-alquilar disponible">
            Alquilar
          </a>
        <?php else: ?>
          <a href="#" class="btn-alquilar no-disponible" onclick="sinStock(event)">
            No disponible
          </a>
        <?php endif; ?>
      </div>
    </div>
  <?php endwhile; ?>
</div>

<script>
  function sinStock(event) {
    event.preventDefault();
    alert("⚠️ Este producto no cuenta con unidades disponibles para alquilar en este momento.");
  }
</script>