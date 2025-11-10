-- By Gaboh - 20250819
-- Database: `prestamvc`

USE prestamvc;

INSERT INTO tipos_usuario (nombre, permisos) VALUES 
('ESTUDIANTE', '{"solicitar_prestamos": true, "ver_productos": true}'),
('ADMINISTRADOR', '{"gestionar_usuarios": true, "aprobar_prestamos": true, "gestionar_productos": true}');

INSERT INTO generos (codigo, nombre, orden) VALUES
('M', 'Masculino', 1),
('F', 'Femenino', 2),
('OTRO', 'Otro', 3);

INSERT INTO tipos_identificacion (codigo, nombre) VALUES
('CC', 'Cédula de Ciudadanía'),
('TI', 'Tarjeta de Identidad'),
('CE', 'Cédula de Extranjería');

INSERT INTO estados_prestamo (nombre, descripcion) VALUES
('SOLICITADO', 'Préstamo solicitado, pendiente de revisión'),
('APROBADO', 'Préstamo aprobado por administrador'),
('RECHAZADO', 'Préstamo rechazado por administrador'),
('ENTREGADO', 'Producto entregado al solicitante'),
('DEVUELTO', 'Producto devuelto satisfactoriamente'),
('CANCELADO', 'Préstamo cancelado por el usuario'),
('VENCIDO', 'Préstamo no devuelto en fecha acordada');

-- Insertar categorías de productos
INSERT INTO categorias_producto (nombre, descripcion, activa) VALUES
('TECNOLOGÍA', 'Equipos tecnológicos y electrónicos para préstamo', TRUE),
('SALAS', 'Espacios físicos y salones de clase', TRUE),
('DINERO', 'Préstamos monetarios para estudiantes', TRUE),
('AUDIOVISUALES', 'Equipos de audio y video para presentaciones', TRUE);


-- Producto 1: Videobeam
INSERT INTO productos (
    nombre, 
    descripcion, 
    id_categoria, 
    cantidad_disponible, 
    valor_aproximado, 
    condiciones_uso, 
    requiere_aprobacion, 
    activo
) VALUES (
    'Videobeam Epson PowerLite X49', 
    'Proyector multimedia de alta definición, 3800 lúmenes, entrada HDMI, VGA y USB. Ideal para presentaciones académicas y proyectos.',
    1, -- TECNOLOGÍA
    3, 
    1800000.00, 
    '• Devolver en un plazo máximo de 48 horas\n• No exponer a luz directa o humedad\n• Incluir todos los cables y control remoto\n• Reportar cualquier falla técnica inmediatamente',
    TRUE, 
    TRUE
);

-- Producto 2: Sala de Estudio
INSERT INTO productos (
    nombre, 
    descripcion, 
    id_categoria, 
    cantidad_disponible, 
    valor_aproximado, 
    condiciones_uso, 
    requiere_aprobacion, 
    activo
) VALUES (
    'Sala de Estudio Grupo A - Biblioteca Central', 
    'Sala equipada para grupos de estudio, capacidad para 8 personas, pizarra acrílica, conexión eléctrica y WiFi de alta velocidad.',
    2, -- SALAS
    1, 
    0.00, -- No aplica valor para salas
    '• Reserva máxima de 4 horas por sesión\n• Mantener el espacio limpio y ordenado\n• Apagar luces y equipos al finalizar\n• Respetar el horario establecido\n• No consumir alimentos, solo bebidas',
    TRUE, 
    TRUE
);

-- Imágenes para el Videobeam (Producto ID 1)
INSERT INTO imagenes_producto (id_producto, url_imagen, es_principal) VALUES
(1, '/assets/images/productos/videobeam-epsom-x49-1.jpg', TRUE),
(1, '/assets/images/productos/videobeam-epsom-x49-2.jpg', FALSE),
(1, '/assets/images/productos/videobeam-especificaciones.jpg', FALSE);

-- Imágenes para la Sala de Estudio (Producto ID 2)
INSERT INTO imagenes_producto (id_producto, url_imagen, es_principal) VALUES
(2, '/assets/images/productos/sala-estudio-grupo-a-1.jpg', TRUE),
(2, '/assets/images/productos/sala-estudio-grupo-a-2.jpg', FALSE),
(2, '/assets/images/productos/sala-estudio-diagrama.jpg', FALSE);


/*
INSERT INTO usuarios VALUES
('761', 'Juan Peréz', 'juan@uno.com', '1234', '3113', 'Calle 1', 1, 1),
('341', 'María Cuellar', 'maria@uno.com', '1234', '3112', 'Carrera 2', 3, 2),
('762', 'Mario Burbano', 'mario@uno.com', '1234', '3111', 'Calle 2', 2, 1);

*/



