# 🎓 Sistema de Microcréditos Universitarios

## 📘 Descripción
Aplicación web desarrollada en **PHP (arquitectura MVC)** para la **gestión de préstamos de recursos universitarios**, como equipos tecnológicos, salas de estudio y microcréditos monetarios.

El sistema permite tanto a estudiantes como a administradores realizar y gestionar solicitudes de préstamo, controlando su estado, devolución y disponibilidad de productos.

---

## 🚀 Características Principales
- 📦 **Préstamo de equipos** (videobeams, laptops, tablets, etc.)
- 🏫 **Reserva de salas de estudio**
- 💰 **Solicitud y gestión de microcréditos monetarios**
- 👥 **Roles de usuario:** Estudiante y Administrador
- 🔄 **Gestión completa de préstamos:** solicitud, aprobación, cancelación, devolución
- 📊 **Actualización automática de inventario** según estado del préstamo
- ⚠️ **Mensajes de error y confirmación** mediante sesiones (`$_SESSION['msgerror']`, `$_SESSION['msgsuccess']`)
- 🧩 **Separación por capas (MVC):** Controladores, Modelos y Vistas
- 🧠 **Depuración y trazabilidad** mediante `error_log` y `console.log` en modo desarrollo

---

## 🧱 Tecnologías Utilizadas
- **Backend:** PHP 7.4+ (nativo, sin frameworks)
- **Frontend:** HTML5, CSS3, JavaScript (vanilla)
- **Base de datos:** MySQL 5.7+
- **Servidor:** Apache (se recomienda XAMPP)
- **Arquitectura:** MVC (Model–View–Controller)

---

## 🛠️ Instalación y Configuración

### 1️⃣ Requisitos previos
- PHP 7.4 o superior  
- MySQL 5.7 o superior  
- Apache Web Server  
- XAMPP (recomendado para entorno local)

### 2️⃣ Instalación
1. Clona o descarga este repositorio en:
C:\xampp\htdocs\microcreditos\

2. Importa la base de datos desde:
database/DbPrestamos.sql

3. Configura la conexión en:
config/conexion.php

4. Accede al sistema desde tu navegador:

http://localhost/microcreditos

---

## 🧩 Estructura del Proyecto

microcreditos/
├── assets/ # Archivos estáticos (CSS, JS, imágenes)
├── config/ # Configuración general y conexión DB
├── controllers/ # Controladores (lógica de negocio)
├── database/ # Scripts SQL de creación y datos
├── models/ # Modelos de base de datos
├── views/ # Vistas (interfaces y plantillas)
├── index.php # Punto de entrada principal
├── .htaccess
├── .gitignore
└── README.md

---

## 🗃️ Base de Datos

Tablas principales:
| Tabla | Descripción |
|-------|--------------|
| `usuarios` | Gestión de usuarios, autenticación y roles |
| `productos` | Inventario de recursos disponibles |
| `prestamos` | Registro de solicitudes, estados y fechas |
| `categorias_producto` | Clasificación de los productos |

### 🧮 Lógica de préstamo y devolución

| Acción | Efecto en préstamo | Efecto en producto |
|--------|--------------------|--------------------|
| **Cancelar** | Estado → “cancelado” | Incrementa `cantidad_disponible` |
| **Devolver** | Estado → “devuelto” | Incrementa `cantidad_disponible` |
| **Solicitar** | Crea nuevo préstamo | Decrementa `cantidad_disponible` |

---

## ⚙️ Funcionalidades Implementadas (Controllers / Models)

### `PrestamoController.php`
- `getLoansByIdUser()` → lista los préstamos del usuario autenticado  
- `cancelarPrestamo()` → permite cancelar solicitudes y libera el producto  
- `marcarComoDevuelto()` → marca préstamos como devueltos y actualiza stock  

### `Prestamo.php` (Modelo)
- `getLoansByIdUser($id_usuario)` → obtiene préstamos por usuario  
- `getPrestamoById($id_prestamo)` → obtiene datos completos de un préstamo  
- `cancelarPrestamo($id_prestamo, $id_usuario)` → cambia estado a “cancelado”  
- `marcarComoDevuelto($id_prestamo, $id_usuario)` → cambia estado a “devuelto”  

### `Producto.php` (Modelo)
- `updateReturnedProduct($id_producto)` → incrementa cantidad disponible  

---

## 🧰 Depuración y Logs

### En consola (solo en desarrollo):
```php
echo "<script>console.log('ERROR: Contraseñas no coinciden');</script>";
echo "<script>console.log('POST:', " . json_encode($_POST) . ");</script>";

En archivo de error PHP:
error_log("Ejecutando INSERT para usuario: " . $sql);
error_log("Usuario: " . var_export($datos, true));

🧾 .gitignore recomendado
/config/parameters.php
/vendor/
/node_modules/
*.log
.DS_Store

🎨 Paleta de Colores Recomendada
| Color              | Uso                         | Código    |
| ------------------ | --------------------------- | --------- |
| Azul institucional | Header, botones principales | `#1E3A8A` |
| Azul claro         | Hover, fondos secundarios   | `#3B82F6` |
| Verde esmeralda    | Confirmaciones y éxito      | `#10B981` |
| Blanco             | Fondo principal             | `#FFFFFF` |
| Gris claro         | Fondo de contenido          | `#F9FAFB` |
| Gris oscuro        | Texto neutro                | `#374151` |

🧑‍💻 Desarrollo

Patrón: MVC (Model–View–Controller)

Lenguaje: PHP nativo

Frontend: HTML, CSS, JS

Base de datos: MySQL

IDE recomendado: VS Code o PhpStorm

Entorno sugerido: XAMPP

🏛️ Licencia

Proyecto académico desarrollado para la Universidad Unicomfacauca
Uso educativo y demostrativo. No destinado a producción comercial.

📂 Estructura esperada en Git
MICROCREDITOS/
├── .git/
├── .gitignore
├── README.md
├── .htaccess
├── index.php
├── controllers/
├── models/
├── views/
├── assets/
└── database/


✨ Última actualización: noviembre 2025
Incluye: funciones de cancelación y devolución, actualización automática de stock y obtención segura de id_producto desde la base de datos.


---