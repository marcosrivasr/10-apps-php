<?php

namespace Notas\views\components;

use Notas\models\Note;

$id = $_GET['id'];

$note = Note::getNote($id);

if ($_POST) {
    $note->updateFromArray($_POST);
    $note->save();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docasdadasdument</title>
    <link rel="stylesheet" href="src/views/resources/main.css">
</head>

<body>
    <?php require 'components/navbar.php'; ?>
    <form action="?view=view&id=<?php echo $id; ?>" method="POST">
        <input type="text" name="title" value="<?php echo $note->getTitle(); ?>" />

        <textarea name="content"><?php echo $note->getContent(); ?></textarea>

        <button>Update</button>
    </form>
</body>

</html>