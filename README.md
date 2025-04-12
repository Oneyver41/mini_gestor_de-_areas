# mini_gestor_de-_areas
Mini Gestor de Tareas Sencillo en PHP
====================================

Descripción:
------------
Este es un mini gestor de tareas web desarrollado en PHP que permite:
- Ver un listado de todas las tareas con su descripción y estado
- Agregar nuevas tareas
- Cambiar el estado de las tareas entre: "por hacer", "en progreso" y "completada"

Requisitos:
-----------
- XAMPP instalado (versión con PHP 7.4 o superior recomendada)
- Servicio Apache activado en XAMPP
- Sesiones de PHP habilitadas

Configuración del entorno:
-------------------------
1. Instalar XAMPP desde: https://www.apachefriends.org/
2. Iniciar el panel de control de XAMPP
3. Activar el servicio Apache
4. Crear una carpeta para el proyecto en: C:\xampp\htdocs\proyecto_prueba
5. Copiar el archivo index.php en esta ubicación

Acceso al proyecto:
------------------
1. Abrir navegador web
2. Ingresar a: http://localhost/proyecto_prueba/

Características técnicas:
------------------------
- Almacenamiento en memoria usando $_SESSION (persistente durante la sesión)
- Interfaz simple y funcional con HTML básico y CSS mínimo
- Validación básica de datos de entrada
- Protección contra XSS con htmlspecialchars()
- Código organizado en un solo archivo con separación lógica-vista

Estructura del código:
---------------------
1. Inicialización de sesión y array de tareas
2. Manejo de formularios:
   - POST para agregar tareas (nuevas entradas)
   - POST para cambiar estados (actualizaciones)
3. Función auxiliar estadoAColor() para visualización
4. Sección HTML con:
   - Formulario de nueva tarea
   - Listado de tareas existentes
   - Formularios para cambiar estado

Uso:
----
1. Abrir la aplicación en el navegador
2. Usar los formularios para:
   - Agregar nuevas tareas (campo de texto y botón)
   - Cambiar estados (select y botón para cada tarea)

Notas:
------
- Los datos se pierden al cerrar el navegador (sesión PHP)
- Diseño minimalista intencional para enfoque en funcionalidad
- Requiere tener XAMPP con Apache en ejecución
