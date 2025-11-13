# Sistema de Microcréditos Universitarios

## Descripción
Sistema web para gestión de préstamos de recursos universitarios (equipos, salas, dinero) desarrollado en PHP con arquitectura MVC.

## Características
- Préstamo de equipos tecnológicos (videobeams, laptops)
- Reserva de salas de estudio
- Solicitud de microcréditos monetarios
- Roles de usuario: Estudiante y Administrador
- Gestión completa de préstamos y devoluciones

## Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Apache Web Server
- XAMPP (recomendado para desarrollo)

## Instalación
1. Clonar/descargar el proyecto en `C:\xampp\htdocs\microcreditos\`
2. Importar la base de datos desde `database/DbPrestamos.sql`
3. Configurar conexión en `config/conexion.php`
4. Acceder via: `http://localhost/microcreditos`

## Estructura del Proyecto

microcreditos/
├── controllers/ # Controladores MVC
├── models/ # Modelos de datos
├── views/ # Vistas y templates
├── config/ # Configuración y parámetros
├── database/ # Scripts de base de datos
├── assets/ # CSS, imágenes, JS
└── index.php # Punto de entrada



## Base de Datos
El sistema utiliza las siguientes tablas principales:
- `usuarios` - Gestión de usuarios y roles
- `productos` - Recursos disponibles para préstamo
- `prestamos` - Registro de solicitudes y estados
- `categorias_producto` - Clasificación de recursos

## Desarrollo
- **Patrón:** MVC (Model-View-Controller)
- **Frontend:** HTML5, CSS3, JavaScript vanilla
- **Backend:** PHP nativo
- **Base de datos:** MySQL

## Licencia
Proyecto académico - Universidad Unicomfacauca

¿Por qué en la raíz?
Visibilidad inmediata - Es lo primero que se ve al abrir el proyecto

Estándar de la industria - Todos los proyectos tienen el README en raíz

Acceso directo - Fácil de encontrar y editar

Compatibilidad con Git - Plataformas como GitHub/GitLab lo esperan en raíz

Si usas Git, también deberías tener:

MICROCREDITOS/
├── .git/               # Carpeta de Git (oculta)
├── .gitignore          # Archivo para ignorar archivos
├── README.md           # Documentación principal
├── .htaccess
├── index.php
└── ... resto de carpetas

El .gitignore para tu proyecto PHP podría contener:


/config/parameters.php  # Configuraciones sensibles
/node_modules/
/vendor/
*.log
.DS_Store


Paleta de colores recomendada:

| Color              | Uso                          | Código    |
| ------------------ | ---------------------------- | --------- |
| Azul institucional | Header y elementos primarios | `#1E3A8A` |
| Azul claro         | Fondo del menú / hover       | `#3B82F6` |
| Verde esmeralda    | Botones o acentos de éxito   | `#10B981` |
| Blanco             | Fondo o texto invertido      | `#FFFFFF` |
| Gris claro         | Fondo del contenido          | `#F9FAFB` |
| Gris oscuro        | Texto neutro                 | `#374151` |



# Console log para poder realizar debug con la consola, solo en modo desarrollo no en producción.
///
echo "<script>console.log('ERROR: Contraseñas no coinciden');</script>";
 echo "<script>console.log('POST:', " . json_encode($_POST) . ");</script>";


Imprimir errores en un archivo .php
error_log("Ejecutando INSERT para usuario: " . $sql);
error_log("Usuario: " . var_export($datos, true));


      error_log("Usuario: " . var_export($datos, true));


 admin1234

///









