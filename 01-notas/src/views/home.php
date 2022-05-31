<?php

namespace Notas\views\components;

use PDO;
use Notas\lib\Database;
use Notas\models\Note;

$notes = [];
$db = new Database();

$query = $db->connect()->query('SELECT * FROM notas');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="src/views/resources/main.css">
</head>

<body>

    <?php
    require 'components/navbar.php';
    echo '<div class="notes-container">';
    while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
        $note = Note::createFromArray($r);
        renderNote($note);
    }
    echo '</div>';


    function renderNote(Note $note)
    {
        echo "<a href='http://localhost/10-apps-php/01-notas?view=view&id={$note->getUUID()}'>";
        echo "<div class='note-preview'>";
        echo "<div class='title'>{$note->getTitle()}</div>";
        echo "<div>Updated: {$note->getUpdatedAt()}</div>";
        echo "</div></a>";
    }

    ?>
</body>

</html>