<?php
session_start();
if (!isset($_SESSION["x"])) {
    header("location: index.php");
    exit;
}

$usuario = htmlentities($_SESSION["x"]);

require_once "controllers/usuarios.php";

$q = isset($_GET['q']) ? trim($_GET['q']) : "";
$usuarios = obtenerListaUsuarios($q);
$cuentas = obtenerCuentas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Información Privada</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>

<?php require "header.php"; ?>

<main>

    <header>
        <h1>Usuarios</h1>
        <p class="muted">Bienvenido, <?= $usuario ?> — aquí puedes buscar, ver, editar o eliminar usuarios.</p>
    </header>

    <!-- BUSCADOR -->
    <section>
        <form method="get" action="info.php">
            <input list="users-list"
                type="search"
                name="q"
                placeholder="Buscar por cuenta"
                value="<?= htmlentities($q) ?>">

            <datalist id="users-list">
                <?php foreach ($cuentas as $c): ?>
                    <option value="<?= htmlentities($c) ?>"></option>
                <?php endforeach; ?>
            </datalist>
        </form>

        <nav>
            <a class="btn" href="crearUsuario.php">Crear usuario</a>
        </nav>
    </section>

    <section class="grid">

        <?php if (count($usuarios) === 0): ?>

            <article class="card">
                <p class="muted">No se encontraron usuarios.</p>
            </article>

        <?php else: ?>

            <?php foreach ($usuarios as $u): ?>
                <a class="card-link" href="verUsuario.php?id=<?= (int)$u['USU_ID'] ?>">
                    <article class="card">
                        <header>
                            <h3><?= htmlentities($u["USU_CUE"]) ?></h3>
                            <span class="badge">ID <?= (int)$u["USU_ID"] ?></span>
                        </header>

                        <p class="muted small">Contraseña: <?= htmlentities($u["USU_MATCH"]) ?></p>
                    </article>
                </a>
            <?php endforeach; ?>

        <?php endif; ?>

    </section>

</main>

<?php require "footer.php"; ?>

</body>
</html>


