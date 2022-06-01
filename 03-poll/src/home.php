<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>

<body>
    <div class="container">

        <h1>Bienvenido</h1>

        <a href="?view=create">Create new poll</a>

        <h3>Polls created</h3>
        <ul>
            <?php

            use Vidamrr\Poll\model\Poll;

            $polls = Poll::getPolls();

            foreach ($polls as $poll) {
                $p = Poll::createFromArray($poll);
                echo "<li><a href='?view=view&id={$p->getUUID()}'>{$p->getTitle()}</a></li>";
            }
            ?>
        </ul>
    </div>
</body>

</html>