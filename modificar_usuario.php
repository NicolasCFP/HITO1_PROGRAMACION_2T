<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";  // Cambia estos valores si es necesario
$password = "curso";
$dbname = "streamweb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario desde la URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Obtener los datos del usuario desde la base de datos
    $sql = "SELECT * FROM usuarios WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado";
        exit;
    }
} else {
    echo "ID no proporcionado";
    exit;
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $edad = $_POST['edad'];
    $plan = $_POST['plan'];
    $paquetes = $_POST['paquetes'];
    $duracion = $_POST['duracion'];

    // Actualizar los datos del usuario en la base de datos
    $sql = "UPDATE usuarios SET 
                nombre = '$nombre', 
                apellidos = '$apellidos', 
                email = '$email', 
                edad = '$edad', 
                plan = '$plan', 
                paquetes = '$paquetes', 
                duracion = '$duracion'
            WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente.";
        header("Location: listar_usuarios.php"); // Redirigir después de la actualización
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Usuario</title>
    <style>
        /* Estilos generales */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }
         /* Imagen de fondo  */
        body {
            background-image: url('../unnamed.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }
        /* Contenedor del título */
        .full-height {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        /* Botón de volver atrás */
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
        }
        /* Formulario para modificar los datos del usuario */
        .back-button {
            background-color: orange;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #e67e22;
        }
        /* Estilos para el título del formulario */
        .form-container {
            width: 100%;
            max-width: 900px;
            margin: 120px auto;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 15px;
        }
         /* Estilos para el título del formulario */
        .form-container h2 {
            text-align: center;
            color: orange;
        }
        /* Estilos para las etiquetas de los inputs */
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        /* Inputs del formulario */
        input[type="text"], input[type="number"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        /* Botón de enviar */
        button {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px;
            border-radi us: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        button:hover {
            background-color: #e67e22;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            color: white;
        }
    </style>
</head>
<body>

    <div class="full-height">
        <div class="title-container">
        <a href="listar_usuarios.php" class="back-button" style="position: absolute; left: 20px;">Volver</a>
            <h1>StreamWeb</h1>
        </div>

        <div style="position: fixed; top: 20px; right: 20px;">
            <a href="index.php" class="back-button">
                Volver al inicio
            </a>
        </div>

        <div class="form-container" style="margin-top: 200px;">
            <h2>Modificar Usuario</h2>
            <form method="POST">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $user['nombre']; ?>" required style="background-color: grey;">

            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $user['apellidos']; ?>" required style="background-color: grey;">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required style="background-color: grey;">

            <label for="edad">Edad</label>
            <input type="number" id="edad" name="edad" value="<?php echo $user['edad']; ?>" required style="background-color: grey;">

            <label for="plan">Plan</label>
            <input type="text" id="plan" name="plan" value="<?php echo $user['plan']; ?>" required style="background-color: grey;">

            <label for="paquetes">Paquete</label>
            <input type="text" id="paquetes" name="paquetes" value="<?php echo $user['paquetes']; ?>" required style="background-color: grey;">

            <label for="duracion">Duración de la suscripción:</label>
            <select id="duracion" name="duracion" required style="width: 100%; padding: 10px; margin: 5px 0; border-radius: 5px; border: 1px solid #ddd; background-color: grey;">
            <option value="mensual" <?php echo ($user['duracion'] == 'mensual') ? 'selected' : ''; ?>>Mensual</option>
            <option value="anual" <?php echo ($user['duracion'] == 'anual') ? 'selected' : ''; ?>>Anual</option>
            </select>

            <button type="submit">Actualizar Usuario</button>
            </form>
        </div>

    </div>

</body>
</html>

<?php
$conn->close();
?>
