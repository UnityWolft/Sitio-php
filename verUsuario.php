<?php
session_start();
if (!isset($_SESSION["x"])) {
    header("location: index.php");
    exit;
}

require_once "conexion.php";
$bd = Bd::pdo();

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$stmt = $bd->prepare("SELECT * FROM USUARIO WHERE USU_ID = :id LIMIT 1");
$stmt->execute([":id" => $id]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$u) {
    die("Usuario no encontrado.");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Usuario <?= htmlentities($u['USU_CUE']) ?></title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

<?php require "header.php"; ?>

<main>

    <header>
        <h1><?= htmlentities($u["USU_CUE"]) ?></h1>
        <p class="muted">ID: <?= $u["USU_ID"] ?></p>
    </header>

    <section class="card">
        <h2>Información del usuario</h2>

        <p><strong>Cuenta:</strong> <?= htmlentities($u["USU_CUE"]) ?></p>
        <p><strong>Contraseña:</strong> <?= htmlentities($u["USU_MATCH"]) ?></p>

        <footer style="margin-top: 20px;">
            <form method="get" action="editarUsuario.php">
                <input type="hidden" name="id" value="<?= $u['USU_ID'] ?>">
                <button class="btn" type="submit">Editar</button>
            </form>

            <form method="post" action="eliminarUsuario.php"
                onsubmit="return confirm('¿Eliminar usuario <?= addslashes($u['USU_CUE']) ?>?');">
                <input type="hidden" name="id" value="<?= $u['USU_ID'] ?>">
                <button class="btn danger" type="submit">Eliminar</button>
            </form>
        </footer>
    </section>

</main>

<?php require "footer.php"; ?>
</body>
</html>
