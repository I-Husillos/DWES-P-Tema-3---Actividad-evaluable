<?php
require_once("../../config/db.php");
require_once("../../model/Item.php");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("No se ha recibido un id");
    }

    try {
        $item = new Item($db);
        $item->setId($_POST['id']);
        if ($item->delete()) {
            header("Location: list_item.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Error al borrar" . $e->getMessage());
    }
} else {
    die("Metodo no permitido maquina");
}