<?php
require_once("../../config/db.php");
require_once("../../model/Character.php");

$characterModel = new Character($db);
$characters = $characterModel->getAll();

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu personaje</title>
</head>

<body>
    <h1>Menu: </h1>
    <?php include('../partials/_menu.php') ?>
    <h1>Crea tu personaje</h1>
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

        <button type="submit">Crear personaje</button>
    </form>

    <h1>Personajes creados: </h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Salud</th>
                <th>Fuerza</th>
                <th>Defensa</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($characters as $character) : ?>
                <tr>
                    <td>img</td>
                    <td><?= $character['name'] ?></td>
                    <td><?= $character['description'] ?></td>
                    <td><?= $character['health'] ?></td>
                    <td><?= $character['strength'] ?></td>
                    <td><?= $character['defense'] ?></td>
                    <td>
                        <form action="edit_character.php" method="GET">
                            <input type="hidden" name="id" value="<?= $character['id'] ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="delete_character.php" method="POST">
                            <input type="hidden" name="id" value="<?= $character['id'] ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>