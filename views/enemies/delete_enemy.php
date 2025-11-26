<?php
require_once("../config/db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(!isset($_POST['id']) || empty($_POST['id'])){
        die("No se ha recibido un id");
    }

    try{
        $stmt = $db->prepare("DELETE FROM enemies WHERE id = :id");
        $stmt->bindParam(':id', $_POST['id']);
        if($stmt->execute()){
            header("Location: create_enemy.php");
            exit;
        }
    } catch(PDOException $e){
        die("Error al borrar" . $e->getMessage());
    }
} else {
    die("Metodo no permitido maquina");
}
?>