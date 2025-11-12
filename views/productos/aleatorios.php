<div class="productos-container">
  <?php while ($data = $productos->fetch_object()): ?>
    <div class="producto-card">
      <img src="<?= base_url ?>assets/images/productos/<?= $data->url_imagen ?>" alt="<?= $data->nombre ?>">

      <div class="producto-info">
        <h3><?= $data->nombre ?></h3>
        <p class="descripcion"><?= $data->descripcion ?></p>
        <p class="condiciones"><strong>Condiciones:</strong> <?= $data->condiciones_uso ?></p>
        <p class="cantidad"><strong>Disponibles:</strong> <?= $data->cantidad_disponible ?></p>
        <a href="#" class="btn-alquilar">Alquilar</a>
      </div>
    </div>
    
  <?php endwhile; ?>
</div>