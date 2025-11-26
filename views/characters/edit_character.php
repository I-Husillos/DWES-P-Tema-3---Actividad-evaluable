<?php
require_once("../../config/db.php");
require_once("../../model/Character.php");

$characterId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($characterId <= 0) {
    echo "ID de personaje inválido.";
    exit;
}

$character = new Character($db);
if (!$character->loadById($characterId)) {
    echo "Personaje no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $character->setName(trim($_POST['name']))
            ->setDescription(trim($_POST['description']))
            ->setHealth(intval($_POST['health']))
            ->setStrength(intval($_POST['strength']))
            ->setDefense(intval($_POST['defense']));
    if ($character->save()) {
        header("Location: list_character.php");
        exit;
    } else {
        echo "Error al actualizar el personaje.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Personaje</title>
</head>

<body>
    <h1>Editar Personaje</h1>
    <form method="POST">
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($character->getName()) ?>" required><br>

        <label for="description">Descripción:</label>
        <textarea name="description" id="description" required><?= htmlspecialchars($character->getDescription()) ?></textarea><br>

        <label for="health">Vida:</label>
        <input type="number" name="health" id="health" value="<?= htmlspecialchars($character->getHealth()) ?>" required><br>

        <label for="strength">Fuerza:</label>
        <input type="number" name="strength" id="strength" value="<?= htmlspecialchars($character->getStrength()) ?>" required><br>

        <label for="defense">Defensa:</label>
        <input type="number" name="defense" id="defense" value="<?= htmlspecialchars($character->getDefense()) ?>" required><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>

</html>