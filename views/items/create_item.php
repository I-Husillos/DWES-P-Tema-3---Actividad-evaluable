<?php

require_once("../config/db.php");
require_once("../model/Item.php");

$items = [];

try {
    $stmt = $db->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error al leer en base de datos: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = new Item($db);
    $item->setName($_POST['name'])
        ->setDescription($_POST['description'])
        ->setType($_POST['type'])
        ->setEffect($_POST['effect'])
        ->setImage($_POST['image']);

    if ($item->save()) {
        echo "Item guardado con exito";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea tu item</title>
</head>
<body>
    <h1>Menu: </h1>
    <?php include('_menu.php') ?>
    <h1>Crea tu item</h1>
    <form action=<?= $_SERVER['PHP_SELF'] ?> method='POST'>
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput">

        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput">

        <label for="typeInput">Tipo:</label>
        <input type="text" name="type" id="typeInput">

        <label for="effectInput">Efecto:</label>
        <input type="text" name="effect" id="effectInput">

        <label for="imageInput">Imagen:</label>
        <input type="text" name="image" id="imageInput">

        <button type="submit">Crear item</button>
    </form>

    <h1>Items creados: </h1>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Tipo</th>
                <th>Efecto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td>img</td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td><?= $item['type'] ?></td>
                    <td><?= $item['effect'] ?></td>
                    <td>
                        <form action="edit_item.php" method="GET">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>" />
                            <button type="submit">Editar</button>
                        </form>
                        <form action="delete_item.php" method="POST">
                            <input type="hidden" name="id" value=<?= $item['id'] ?>" />
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>