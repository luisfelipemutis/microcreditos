<div class="Conthcc">
  <?php while ($data = $productos->fetch_object()): ?>
    <div class="product">
      <img src="<?= base_url ?>assets/images/productos/<?= $data->url_imagen ?>">
      <h3><?= $data->nombre ?></h3>
      <p>Descripción: <?= $data->descripcion ?></p>
      <p>Condiciones de uso: <?= $data->condiciones_uso ?></p>
      <a href="#" class="Bt1">Alquilar</a>
    </div>
  <?php endwhile; ?>
</div>