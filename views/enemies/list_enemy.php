<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");

$enemyModel = new Enemy($db);
$enemies = $enemyModel->getAll();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu enemigo</title>
</head>
<body>
    <h1>Menu: </h1>
    <?php include('../partials/_menu.php') ?>
    <h1>Crea tu enemigo</h1>
    <form action=<?= $_SERVER['PHP_SELF'] ?> method='POST'>
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput">

        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput">

        <label for="healthInput">Vida:</label>
        <input type="number" name="health" id="healthInput" value="100">

        <label for="strengthInput">Fuerza:</label>
        <input type="nummber" name="strength" id="strengthInput" value="10">

        <label for="defenseInput">Defensa:</label>
        <input type="number" name="defense" id="defenseInput" value="10">

        <button type="submit">Crear enemigo</button>
    </form>

    <h1>Enemigos creados: </h1>
    <table border="1">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Es Boss</th>
                <th>Descripcion</th>
                <th>Salud</th>
                <th>Fuerza</th>
                <th>Defensa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enemies as $enemy) : ?>
                <tr>
                    <td>img</td>
                    <td><?= $enemy['name'] ?></td>
                    <td><?= $enemy['isBoss'] ?></td>
                    <td><?= $enemy['description'] ?></td>
                    <td><?= $enemy['health'] ?></td>
                    <td><?= $enemy['strength'] ?></td>
                    <td><?= $enemy['defense'] ?></td>
                    <td>
                        <form action="edit_enemy.php" method="GET">
                            <input type="hidden" name="id" value="<?= $enemy['id'] ?>" />
                            <button type="submit">Editar</button>
                        </form>
                        <form action="delete_enemy.php" method="POST">
                            <input type="hidden" name="id" value="<?= $enemy['id'] ?>" />
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>