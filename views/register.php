<?php
// views/register.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../controllers/UserController.php';

    $dbConfig = require __DIR__ . '/../config/database.php';

    try {
        $conn = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}", $dbConfig['username'], $dbConfig['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $controller = new UserController($conn);
        $message = $controller->createUser($_POST);
    } catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage());
        $message = "An error occurred while connecting to the database.";
    } finally {
        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../public/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
</head>

<body>
    <div class="container">
        <h2 class="bg-dark text-white">Formulario de Registro</h2>

        <?php if (isset($message)) : ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <form id="formulario" method="post" action="">
            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Ingrese sus nombres" />
                <span class="error" id="errorNombres"></span>
            </div>

            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Ingrese sus apellidos" />
                <span class="error" id="errorApellidos"></span>
            </div>

            <div class="form-group">
                <label for="cedulaRUC">Cédula/RUC:</label>
                <input type="text" class="form-control" id="cedulaRUC" name="cedulaRUC" placeholder="Ingrese su cédula o RUC" />
                <span class="error" id="errorCedulaRUC"></span>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingrese su teléfono" />
                <span class="error" id="errorTelefono"></span>
            </div>

            <div class="form-group">
                <label for="fechaNacimiento">Fecha de nacimiento:</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" />
                <span class="error" id="errorFechaNacimiento"></span>
            </div>

            <div class="form-group">
                <label for="salario">Salario:</label>
                <input type="number" class="form-control" id="salario" name="salario" placeholder="Ingrese su salario" />
                <span class="error" id="errorSalario"></span>
            </div>

            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico" />
                <span class="error" id="errorEmail"></span>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingrese su contraseña" />
                <span class="error" id="errorContrasena"></span>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="../public/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>