<?php
// Conexión a la base de datos
$servername = "localhost"; // Nombre 
$username = "root";  // Cambia estos valores si es necesario
$password = "curso"; // Contraseña
$dbname = "streamweb";// Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se ha pasado el parámetro 'id' para eliminar un usuario
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = $userId";
    // Verificar si la consulta se ha ejecutado correctamente
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }

    // Redirigir a la lista de usuarios después de eliminar
    header("Location: listar_usuarios.php");
    exit();
}

// Obtener los usuarios de la base de datos
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        /* Estilos generales */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /*Evita el deslizamiento */
        }
        /*Fondo de la pagina con imagen */
        body {
            background-image: url('../unnamed.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
          /* Contenedor principal que ocupa toda la pantalla */
        .full-height {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Estilos para el encabezado negro con texto naranja */
        .title-container {
            text-align: center;
            background-color: black;
            color: orange;
            padding: 40px 20px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Botón de regreso al inicio */
        .back-button {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            position: absolute;
            left: 20px;
        }
        .back-button:hover {
            background-color: #e67e22;
        }
         /* Contenedor principal con desplazamiento */
        .content-container {
            flex: 1;
            overflow-y: auto;
            padding-top: 200px; /* Ajustar para evitar superposición con el título */
        }
        /* Tarjeta que contiene la tabla */
        .table-card {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 15px;
        }
          /* Título dentro de la tarjeta */
        .table-card h2 {
            text-align: center;
            color: orange;
        }
         /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }
          /* Encabezados de la tabla */
        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: orange;
            color: white;
        }

        td {
            background-color: white;
            color: black;
        }
         /* Estilos de los botones de acción */
        button {
            background-color: orange;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
        <!-- Contenedor principal de la página -->
    <div class="full-height">
        <div class="title-container">
            <a href="index.php" class="back-button">Volver al inicio</a>
            <h1>StreamWeb</h1>
        </div>

        <div class="content-container">
            <div class="table-card">
                <header>
                    <h2 style="text-align: center; color: orange;">Usuarios Registrados</h2>
                </header>

                <main>
                    <?php if ($result->num_rows > 0): ?>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Edad</th>
                                <th>Plan</th>
                                <th>Paquete</th>
                                <th>Duración</th>
                                <th>Acciones</th>
                            </tr>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['apellidos']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['edad']; ?></td>
                                    <td><?php echo $row['plan']; ?></td>
                                    <td><?php echo $row['paquetes']; ?></td>
                                    <td><?php echo $row['duracion']; ?></td>
                                    <td>
                                        <a href="modificar_usuario.php?id=<?php echo $row['id']; ?>"><button>Modificar</button></a>
                                        <a href="listar_usuarios.php?id=<?php echo $row['id']; ?>"><button>Eliminar</button></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </table>
                    <?php else: ?>
                        <p>No hay usuarios registrados.</p>
                    <?php endif; ?>
                </main>

            </div>
        </div>
    </div>

</body>
</html>

<?php
$conn->close();
?>
