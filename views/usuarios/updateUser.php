<?php
if (!isset($_SESSION['identity'])) {
    echo "<p>No tienes acceso a esta sección.</p>";
    exit;
}

$user = $_SESSION['identity'];
?>

<div class="update-container">
    <form action="<?= base_url ?>Usuario/update" method="POST" class="update-form" id="formUpdateUser">
        <h2>Actualizar Información del Usuario</h2>
        <p class="update-subtitle">Solo puedes editar los campos habilitados</p>

        <div class="update-grid">
            <!-- Columna 1 -->
            <div class="update-column">
                <label>Tipo de Identificación</label>
                <input type="text" value="<?= $user->tipo_identificacion ?? 'No especificado' ?>" disabled>

                <label>Número de Identificación</label>
                <input type="text" value="<?= $user->identificacion ?>" disabled>

                <label for="nombres">Nombres</label>
                <input type="text" name="nombre" id="nombres" value="<?= $user->nombres ?>" required>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellido" id="apellidos" value="<?= $user->apellidos ?>" required>
            </div>

            <!-- Columna 2 -->
            <div class="update-column">
                <label>Género</label>
                <input type="text" value="<?= $user->genero ?? 'No especificado' ?>" disabled>

                <label for="email">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="<?= $user->email ?>" required>

                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" id="telefono" value="<?= $user->telefono ?>" required>

                <label>Tipo de Usuario</label>
                <input type="text" value="<?= $user->tipo_usuario ?? 'Estudiante' ?>" disabled>
            </div>
        </div>

        <div class="update-buttons">
            <input type="submit" value="Guardar Cambios" id="btnGuardar" class="Bt4b" disabled>
            <input type="button" value="Cancelar" class="Bt4r" id="btnCancelar"
                onclick="location.href='<?= base_url ?>'">
        </div>
    </form>
</div>

<script>
    const form = document.getElementById('formUpdateUser');
    const btnGuardar = document.getElementById('btnGuardar');
    const camposEditables = form.querySelectorAll('#nombres, #apellidos, #email, #telefono');

    camposEditables.forEach(campo => {
        campo.addEventListener('input', () => {
            btnGuardar.disabled = false;
        });
    });

    document.getElementById('btnCancelar').addEventListener('click', () => {
        form.reset();
        btnGuardar.disabled = true;
    });
</script>