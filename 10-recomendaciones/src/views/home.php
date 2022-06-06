<?php

use Vidamrr\Suggestions\model\Suggestion;

if (isset($_POST['q'])) {
    $q = $_POST['q'];
    Suggestion::saveSearch($q);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">

        <form action="?view=home" method="post">
            <input type="text" name="q">
        </form>

        <div class="suggestions">
            <?php
            $suggestions = Suggestion::getSuggestions();

            foreach ($suggestions as $suggestion) {
                echo "<div>{$suggestion['title']}</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>