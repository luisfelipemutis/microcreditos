-- Database: `prestamvc`

CREATE DATABASE IF NOT EXISTS `prestamvc` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE prestamvc;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------
-- PARAMETRIC TABLES --
-- --------------------

-- 01
-- Table structure for table `tipos_usuario`
--
CREATE TABLE IF NOT EXISTS `tipos_usuario` (
    id_tipo_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL, -- 'ESTUDIANTE', 'ADMINISTRADOR', 'PROFESOR'
    permisos JSON
);

-- 02
-- Table structure for table `generos`
--
CREATE TABLE IF NOT EXISTS `generos` (
    id_genero INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(10) UNIQUE NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    orden INT DEFAULT 0
);

-- 03
-- Table structure for table `tipos_identificacion`
--
CREATE TABLE tipos_identificacion (
    id_tipo_identificacion INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(10) UNIQUE NOT NULL, -- 'CC', 'TI', 'CE', etc.
    nombre VARCHAR(50) NOT NULL, -- 'Cédula de Ciudadanía'
    activo BOOLEAN DEFAULT TRUE
);

-- 04
-- Table structure for table `usuarios`
--
CREATE TABLE usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    id_tipo_identificacion INT NOT NULL,
    identificacion VARCHAR(20) UNIQUE NOT NULL,
    id_genero INT,
    email VARCHAR(150) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    id_tipo_usuario INT NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    activo BOOLEAN DEFAULT TRUE,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_tipo_identificacion) REFERENCES tipos_identificacion(id_tipo_identificacion),
    FOREIGN KEY (id_genero) REFERENCES generos(id_genero),
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipos_usuario(id_tipo_usuario)
);

-- 05
-- Table structure for table `categorias_producto`
--
CREATE TABLE categorias_producto (
    id_categoria INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL, -- 'TECNOLOGÍA', 'SALAS', 'DINERO'
    descripcion TEXT,
    activa BOOLEAN DEFAULT TRUE
);


-- 06
-- Table structure for table `productos`
--
CREATE TABLE productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(200) NOT NULL,
    descripcion TEXT,
    id_categoria INT NOT NULL,
    cantidad_disponible INT DEFAULT 1,
    valor_aproximado DECIMAL(10,2),
    condiciones_uso TEXT,
    requiere_aprobacion BOOLEAN DEFAULT TRUE,
    activo BOOLEAN DEFAULT TRUE,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias_producto(id_categoria)
);

-- 07
-- Table structure for table `imagenes_producto`
--
CREATE TABLE imagenes_producto (
    id_imagen INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT NOT NULL,
    url_imagen VARCHAR(500) NOT NULL,
    es_principal BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto) ON DELETE CASCADE
);

-- 08
-- Table structure for table `estados_prestamo`
--
CREATE TABLE estados_prestamo (
    id_estado INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL, -- 'SOLICITADO', 'APROBADO', 'RECHAZADO', 'ENTREGADO', 'DEVUELTO', 'CANCELADO'
    descripcion VARCHAR(200)
);

-- 09
-- Table structure for table `préstamos`
--
CREATE TABLE prestamos (
    id_prestamo INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario_solicitante INT NOT NULL,
    id_producto INT, -- NULL para préstamos de dinero
    tipo_prestamo ENUM('PRODUCTO', 'DINERO') NOT NULL,
    monto_solicitado DECIMAL(10,2) DEFAULT 0.00, -- Solo para dinero
    motivo_solicitud TEXT NOT NULL,
    fecha_solicitud DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_prestamo DATE, -- Fecha cuando se necesita el préstamo
    fecha_devolucion DATE, -- Fecha estimada de devolución
    id_estado_actual INT DEFAULT 1, -- 1 = SOLICITADO
    id_usuario_aprobador INT, -- Administrador que aprueba
    fecha_aprobacion DATETIME,
    observaciones_aprobacion TEXT,
    FOREIGN KEY (id_usuario_solicitante) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES productos(id_producto),
    FOREIGN KEY (id_estado_actual) REFERENCES estados_prestamo(id_estado),
    FOREIGN KEY (id_usuario_aprobador) REFERENCES usuarios(id_usuario)
);

-- 10
-- Table structure for table `historial_prestamo`
--
CREATE TABLE historial_prestamo (
    id_historial INT PRIMARY KEY AUTO_INCREMENT,
    id_prestamo INT NOT NULL,
    id_estado INT NOT NULL,
    observaciones TEXT,
    id_usuario_cambio INT, -- Quién realizó el cambio
    fecha_cambio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_prestamo) REFERENCES prestamos(id_prestamo),
    FOREIGN KEY (id_estado) REFERENCES estados_prestamo(id_estado),
    FOREIGN KEY (id_usuario_cambio) REFERENCES usuarios(id_usuario)
);