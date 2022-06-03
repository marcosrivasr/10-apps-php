<?php

use Vidamrr\Stock\model\Stock;

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    if (!Stock::exists($name)) {
        $stock = new Stock($name);
        if ($stock->stockIsReal()) {
            $stock->save();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/views/main.css">
</head>

<body>

    <div class="container">
        <form action="" method="POST">
            <input type="text" name="name">
            <input type="submit" value="Agregar">
        </form>

        <div>
            <?php
            $stocks = Stock::getAll();

            foreach ($stocks as $stock) {
                echo "<div class='stock'><div>{$stock->getTicker()}</div> <div>{$stock->getName()}</div> <div>$ {$stock->getStock()->lastPrice}</div></div>";
            }
            ?>
        </div>

    </div>

</body>

</html>