<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");

$enemyId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($enemyId <= 0) {
    echo "ID de enemigo inválido.";
    exit;
}

$enemy = new Enemy($db);
if (!$enemy->loadById($enemyId)) {
    echo "Enemigo no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $enemy->setName(trim($_POST['name']))
            ->setIsBoss(isset($_POST['isBoss']) ? 1 : 0)
            ->setDescription(trim($_POST['description']))
            ->setHealth(intval($_POST['health']))
            ->setStrength(intval($_POST['strength']))
            ->setDefense(intval($_POST['defense']));
    if ($enemy->save()) {
        header("Location: list_enemy.php");
        exit;
    } else {
        echo "Error al actualizar el enemigo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Enemigo</title>
</head>
<body>
    <h1>Editar Enemigo</h1>
    <form method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($enemy->getName()) ?>" required><br>

        <label for="isBoss">Es Boss:</label>
        <input type="checkbox" name="isBoss" id="isBoss" value="<?= $enemy->getIsBoss() ? 'checked' : ''?>"><br>

        <label for="description">Descripción:</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($enemy->getDescription()) ?></textarea><br>

        <label for="health">Vida:</label>
        <input type="number" name="health" id="health" value="<?= htmlspecialchars($enemy->getHealth()) ?>" required><br>

        <label for="strength">Fuerza:</label>
        <input type="number" name="strength" id="strength" value="<?= htmlspecialchars($enemy->getStrength()) ?>" required><br>

        <label for="defense">Defensa:</label>
        <input type="number" name="defense" id="defense" value="<?= htmlspecialchars($enemy->getDefense()) ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>