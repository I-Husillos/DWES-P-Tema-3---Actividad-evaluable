<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['id']) || empty($_POST['id'])){
        die("No se ha recibido un id");
    }

    try{
        $enemy = new Enemy($db);
        $enemy->setId($_POST['id']);
        if($enemy->delete()){
            header("Location: list_enemy.php");
            exit;
        }
    } catch(PDOException $e){
        die("Error al borrar" . $e->getMessage());
    }
} else {
    die("Metodo no permitido maquina");
}
?>