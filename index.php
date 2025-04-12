<?php
session_start();

// Inicializar el array de tareas si no existe
if (!isset($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [];
}

// Manejar la adición de una nueva tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_tarea'])) {
    $descripcion = trim($_POST['descripcion'] ?? '');

    if (!empty($descripcion)) {
        $nuevaTarea = [
            'id' => uniqid(),
            'descripcion' => htmlspecialchars($descripcion),
            'estado' => 'por hacer'
        ];

        array_unshift($_SESSION['tareas'], $nuevaTarea);
    }
}

// Manejar el cambio de estado de una tarea
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_estado'])) {
    $id = $_POST['id'] ?? '';
    $nuevoEstado = $_POST['nuevo_estado'] ?? '';

    if (!empty($id) && !empty($nuevoEstado)) {
        foreach ($_SESSION['tareas'] as &$tarea) {
            if ($tarea['id'] === $id) {
                $tarea['estado'] = $nuevoEstado;
                break;
            }
        }
        unset($tarea); // Importante: eliminar la referencia después del bucle
    }
}

// Función para traducir el estado a un color
function estadoAColor($estado)
{
    switch ($estado) {
        case 'por hacer':
            return 'lightgray';
        case 'en progreso':
            return 'lightblue';
        case 'completada':
            return 'lightgreen';
        default:
            return 'white';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Mini Gestor de Tareas</title>
</head>

<body>
    <h1>Mini Gestor de Tareas</h1>

    <!-- Formulario para agregar nueva tarea -->
    <form method="POST">
        <h2>Agregar Nueva Tarea</h2>
        <input type="text" name="descripcion" placeholder="Descripción de la tarea" required>
        <button type="submit" name="agregar_tarea">Agregar Tarea</button>
    </form>

    <!-- Listado de tareas -->
    <h2>Listado de Tareas</h2>
    <?php if (empty($_SESSION['tareas'])): ?>
        <p>No hay tareas registradas.</p>
    <?php else: ?>
        <?php foreach ($_SESSION['tareas'] as $tarea): ?>
            <div class="tarea" style="background-color: <?php echo estadoAColor($tarea['estado']); ?>">
                <p><strong>Descripción:</strong> <?php echo $tarea['descripcion']; ?></p>
                <p><strong>Estado:</strong> <?php echo ucfirst($tarea['estado']); ?></p>

                <!-- Formulario para cambiar estado -->
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="id" value="<?php echo $tarea['id']; ?>">
                    <select name="nuevo_estado">
                        <option value="por hacer" <?php echo $tarea['estado'] === 'por hacer' ? 'selected' : ''; ?>>Por hacer</option>
                        <option value="en progreso" <?php echo $tarea['estado'] === 'en progreso' ? 'selected' : ''; ?>>En progreso</option>
                        <option value="completada" <?php echo $tarea['estado'] === 'completada' ? 'selected' : ''; ?>>Completada</option>
                    </select>
                    <button type="submit" name="cambiar_estado">Cambiar Estado</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>

</html>