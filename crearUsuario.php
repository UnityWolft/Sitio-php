<?php
require_once "conexion.php";
require_once "recuperaTexto.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
?><!DOCTYPE html>
<html lang="es">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width">
 <title>Crear Usuario</title>
 <link rel="stylesheet" href="./css/index.css">
</head>
<body>
 <?php require "header.php"; ?>

 <main class="login-wrap">
    <section class="login-card">
        <h1>Crear Usuario Nuevo</h1>

        <form action="procesaCrearUsuario.php" method="post">
            <input type="text" name="cue" placeholder="Cuenta" required>
            <input type="password" name="matc" placeholder="Contraseña" required>
            <button type="submit" class="btn">Registrar</button>
        </form>

        <p class="register-link"><a href="index.php">Volver</a></p>
    </section>
 </main>

 <?php require "footer.php"; ?>
</body>
</html>
<?php
exit;
}
