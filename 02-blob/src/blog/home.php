<?php

use Vidamrr\Blog\utils\Post;
use Vidamrr\Blog\utils\Url;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Blog</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>

<body>
    <?php
    Url::require('/resources/menu.php');
    //require 'src/resources/menu.php';
    ?>
    <main>


        <?php
        $arrFiles = scandir(__DIR__ . '/entries');
        $arrPosts = [];

        foreach ($arrFiles as $file) {
            if (strlen($file) > 2) {
                $post = new Post($file);
                array_push($arrPosts, $post);
            }
        }

        foreach ($arrPosts as $post) {
            echo "<div class='post-item'><a href='{$post->getUrl()}'>{$post->getTitle()}</div>";
        }

        ?>
    </main>
</body>

</html>