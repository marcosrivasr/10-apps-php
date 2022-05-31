<?php

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;
use Vidamrr\Blog\utils\Url;

// Define your configuration, if needed
$config = [
    'table' => [
        'wrap' => [
            'enabled' => false,
            'tag' => 'div',
            'attributes' => [],
        ],
    ],
];

// Configure the Environment with all the CommonMark parsers/renderers
$environment = new Environment($config);
$environment->addExtension(new CommonMarkCoreExtension());

// Add this extension
$environment->addExtension(new TaskListExtension());
$environment->addExtension(new TableExtension());

// Instantiate the converter engine and start converting some Markdown!
$converter = new MarkdownConverter($environment);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>

<body>
    <?php
    Url::require('/resources/menu.php');
    //require 'src/resources/menu.php';
    ?>

    <main>
        <h1><?php echo $post->getTitle(); ?></h1>

        <?php
        $text = explode('<br />', nl2br($post->getContent()));
        foreach ($text as $line) {
            echo $converter->convert($line);
        }
        ?>

    </main>
</body>

</html>