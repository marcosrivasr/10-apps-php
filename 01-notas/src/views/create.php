<?php

namespace Notas\views\components;

use PDO;
use Notas\lib\Database;
use Notas\models\Note;


if ($_POST) {
    $db = new Database();

    $note = Note::createFromArray($_POST);

    $query = $db->connect()->prepare("INSERT INTO notas(uuid, title, content, updated_at) values(:uuid, :title, :content, :updated)");
    $query->execute(['uuid' => $note->getUUID(), 'title' => $note->getTitle(), 'content' => $note->getContent(), 'updated' => $note->getUpdatedAt()]);
    header("Location: http://localhost/10-apps-php/01-notas/?view=home");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="src/views/resources/main.css">
</head>

<body>
    <?php require 'components/navbar.php'; ?>
    <form action="?view=create" method="POST">
        <input name="title" type="text" placeholder="Title" />

        <textarea name="content"></textarea>

        <button>Update</button>
    </form>
</body>

</html>