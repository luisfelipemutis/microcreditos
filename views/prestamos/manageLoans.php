<?php
if (!isset($_SESSION['identity'])) {
    echo "<p>No tienes acceso a esta sección.</p>";
    exit;
}

if (!isset($loans)) {
    $loans = false;
}
?>

<div class="manage-loans-container">
    <h2>Mis Préstamos</h2>
    <p class="subtitle">Consulta el estado de tus solicitudes y gestiona tus préstamos activos.</p>

    <div class="table-wrapper">
        <table class="loans-table">
            <thead>
                <tr>
                    <th>ID Préstamo</th>
                    <th>Producto</th>
                    <th>Motivo</th>
                    <th>Fecha Solicitud</th>
                    <th>Fecha Devolución</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($loans && is_object($loans) && $loans->num_rows > 0): ?>
                    <?php while ($loan = $loans->fetch_object()): ?>
                        <tr>
                            <td><?= $loan->id_prestamo ?></td>
                            <td><?= htmlspecialchars($loan->producto_nombre ?? 'N/D') ?></td>
                            <td><?= htmlspecialchars($loan->motivo_solicitud) ?></td>
                            <td><?= date('d/m/Y', strtotime($loan->fecha_solicitud)) ?></td>
                            <td><?= date('d/m/Y', strtotime($loan->fecha_devolucion)) ?></td>
                            <td><span class="estado"><?= htmlspecialchars($loan->estado_nombre ?? 'Solicitado') ?></span></td>
                            <td>
                                <?php if ((int) $loan->id_estado_actual === 1): // solicitado ?>
                                    <a href="<?= base_url ?>index.php?controller=Prestamo&action=cancelarPrestamo&id=<?= $loan->id_prestamo ?>"
                                        class="btn-cancelar"
                                        onclick="return confirm('¿Seguro que deseas cancelar esta solicitud?');">
                                        Cancelar
                                    </a>
                                <?php elseif ((int) $loan->id_estado_actual === 2): // aprobado ?>
                                    <a href="<?= base_url ?>index.php?controller=Prestamo&action=marcarComoDevuelto&id=<?= $loan->id_prestamo ?>"
                                        class="btn-devolver"
                                        onclick="return confirm('¿Confirmas que has devuelto este préstamo?');">
                                        Devolver
                                    </a>
                                <?php else: ?>
                                    <span class="sin-accion">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="sin-prestamos">No tienes préstamos registrados actualmente.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>