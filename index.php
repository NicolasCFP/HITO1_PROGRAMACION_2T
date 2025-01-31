<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamWeb - Página de Inicio</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Hace que la pagina ocupe todo el espacio y no tenga scroll */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Hace que no se pueda deslizar */
        }

        /* Fondo de la pagina */
        body {
            background-image: url('../unnamed.png'); /* Imagen de fondo */
            background-size: cover; /* Ajusta la imagen de fondo para que cubra toda la pantalla */
            background-position: center; /* Centra la imagen */
            background-attachment: fixed; /* Fija la imagen de fondo */
            background-repeat: no-repeat; /* Evita que la imagen se duplique muchas veces */
        }

        /* Estructura de la pagina */
        .full-height {
            height: 100vh; /* Ocupa el 100% de la pantalla */
            display: flex;
            flex-direction: column; /* Alinea los elementos en columna */
        }

        /* Estilos para el título */
        .title-container {
            text-align: center; /* Centra el texto */
            background-color: black; /* Fondo negro */
            color: orange; /* Texto en color naranja */
            padding: 40px 20px; /* Espaciado alrededor del texto */
            width: 100%; /* Ocupa todo el ancho de la pantalla */
            position: fixed; /* No permite deslizar */
            top: 0; /* Se coloca en la parte superior */
            left: 0;
            z-index: 10; /* Hace que el titulo este por encima de lo demas */
        }

        /*  Botones centrado en la pantalla */
        .center-container {
            display: flex;
            justify-content: center; /* Centra horizontalmente */
            align-items: center; /* Centra verticalmente */
            flex-grow: 1; /* Ocupa el espacio restante de la pantalla */
            margin-top: 120px; /* Deja espacio suficiente para el título */
        }

        /* Estilos para la tarjeta negra donde están los botones */
        .card {
            width: 100%;
            max-width: 500px; /* Tamaño máximo de la tarjeta */
            background-color: black; /* Fondo negro */
            border-radius: 15px; /* Bordes redondos */
        }

        /* Estilos para los botones */
        .btn-primary {
            background-color: orange; /* Color naranja */
            border-color: orange;
        }

        /* Efecto al pasar el ratón sobre el botón */
        .btn-primary:hover {
            background-color: #e67e22; /* Un tono más oscuro de naranja */
            border-color: #e67e22;
        }

        /* Estilos para el segundo botón */
        .btn-secondary {
            background-color: orange; /* También en naranja */
            border-color: orange;
        }

        /* Efecto hover para el segundo botón */
        .btn-secondary:hover {
            background-color: #e67e22; /* igual que el otro */
            border-color: #e67e22;
        }
    </style>
</head>
<body class="bg-light"> 

    <div class="full-height">
        <!-- Título en la parte superior -->
        <div class="title-container">
            <h1>Bienvenido a StreamWeb</h1> <!-- Titulo -->
        </div>

        <!-- Contenedor donde están los botones -->
        <div class="center-container">
            <div class="card p-5"> <!-- Tarjeta negra -->
                <div class="card-body">
                    <!-- Botón para ir a la página de suscripción -->
                    <a href="suscripcion.php" class="btn btn-primary btn-block mb-3">Suscribirse</a>
                    <!-- Botón para ir a la página de lista de usuarios -->
                    <a href="listar_usuarios.php" class="btn btn-secondary btn-block">Listar Usuarios</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
