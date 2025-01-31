<?php
// Conexión a la base de datos
$servername = "localhost"; // Nombre de usuario 
$username = "root";  // Cambia estos valores si es necesario
$password = "curso";// Contraseña
$dbname = "streamweb"; // Nombre de la base de datos

//Conexion a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $edad = $_POST['edad'];
    $plan = $_POST['plan'];
    $paquete = $_POST['paquete'];
    $duracion = $_POST['duracion']; // Obtener la duración seleccionada

    // Insertar los datos del usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, edad, plan, paquetes, duracion) 
            VALUES ('$nombre', '$apellido', '$email', '$edad', '$plan', '$paquete', '$duracion')";

// Verificar si la consulta se ha ejecutado correctamente
    if ($conn->query($sql) === TRUE) {
        header("Location: listar_usuarios.php"); // Redirigir a la lista de usuarios después de la inserción
        exit();
    } else {
        echo "Error al suscribir: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción</title>
    <style>
        /* Estilos generales */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        body {
            background-image: url('../unnamed.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .full-height {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

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

        .form-container {
            width: 100%;
            max-width: 900px;
            margin: 120px auto;
            background-color: black;
            color: white;
            padding: 20px;
            border-radius: 15px;
        }

        .form-container h2 {
            text-align: center;
            color: orange;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"], input[type="number"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            background-color: orange;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
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
    <script>
        // Función para validar el formulario
        function validateForm() {
            const edad = document.getElementById('edad').value;
            const plan = document.getElementById('plan').value;
            const paquete = document.getElementById('paquete').value;
            const duracion = document.getElementById('duracion').value;

            // Restricción para usuarios menores de 18 años
            if (edad < 18 && paquete !== 'Infantil') {
                alert('Los usuarios menores de 18 años solo pueden contratar el Pack Infantil.');
                return false;
            }

            // Restricción para el Plan Básico
            if (plan === 'basico' && paquete !== 'Infantil') {
                alert('Los usuarios del Plan Básico solo pueden seleccionar un paquete adicional.');
                return false;
            }

            // Restricción para el Pack Deporte
            if (paquete === 'Deporte' && duracion !== 'anual') {
                alert('El Pack Deporte solo puede ser contratado si la duración de la suscripción es de 1 año.');
                return false;
            }

            return true; // Enviar el formulario si todas las validaciones son correctas
        }
    </script>
</head>
<body>

    <div class="full-height">
        <div class="title-container">
            <a href="index.php" class="back-button" style="margin-right: auto;">Volver al inicio</a>
            <h1>StreamWeb</h1>
        </div>

        <div class="form-container">
            <div class="form-card" style="padding: 40px;">
                <header>
                    <h2 style="text-align: center; color: orange;">Suscripción</h2>
                    <form method="POST" onsubmit="return validateForm()">
                        <div style="text-align: center;">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required style="background-color: grey; display: block; margin: 0 auto;"><br>

                            <label for="apellido">Apellido:</label>
                            <input type="text" id="apellido" name="apellido" required style="background-color: grey; display: block; margin: 0 auto;"><br>

                            <label for="email">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" required style="background-color: grey; display: block; margin: 0 auto;"><br>

                            <label for="edad">Edad:</label>
                            <input type="number" id="edad" name="edad" required style="background-color: grey; display: block; margin: 0 auto;"><br>

                            <label for="plan">Tipo de plan:</label>
                            <select id="plan" name="plan" required style="background-color: grey; display: block; margin: 0 auto;">
                                <option value="basico">Plan Básico (1 dispositivo) - 9,99 €</option>
                                <option value="estandar">Plan Estándar (2 dispositivos) - 13,99 €</option>
                                <option value="premium">Plan Premium (4 dispositivos) - 17,99 €</option>
                            </select><br>

                            <label for="paquete">Pack:</label>
                            <select id="paquete" name="paquete" required style="background-color: grey; display: block; margin: 0 auto;">
                                <option value="Deporte">Deporte - 6,99 €</option>
                                <option value="Cine">Cine - 7,99 €</option>
                                <option value="Infantil">Infantil - 4,99 €</option>
                            </select><br>

                            <!-- Nuevo campo para la duración -->
                            <label for="duracion">Duración:</label>
                            <select id="duracion" name="duracion" required style="background-color: grey; display: block; margin: 0 auto;">
                                <option value="mensual">Mensual</option>
                                <option value="anual">Anual</option>
                            </select><br>

                            <button type="submit">Suscribirse</button>
                        </div>
                    </form>
                </header>
            </div>
        </div>
    </div>

    

</body>
</html>
