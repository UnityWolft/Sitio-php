<?php
require_once __DIR__ . "/../conexion.php";

function obtenerListaUsuarios($busqueda = "") {
    $bd = Bd::pdo();

    if ($busqueda === "") {
        $stmt = $bd->query("SELECT USU_ID, USU_CUE, USU_MATCH FROM USUARIO ORDER BY USU_ID DESC");
    } else {
        $stmt = $bd->prepare("SELECT USU_ID, USU_CUE, USU_MATCH 
                              FROM USUARIO 
                              WHERE USU_CUE LIKE :q 
                              ORDER BY USU_ID DESC");
        $stmt->execute([":q" => "%$busqueda%"]);
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerCuentas() {
    $bd = Bd::pdo();
    $allStmt = $bd->query("SELECT USU_CUE FROM USUARIO ORDER BY USU_CUE LIMIT 500");
    return $allStmt->fetchAll(PDO::FETCH_COLUMN, 0);
}
