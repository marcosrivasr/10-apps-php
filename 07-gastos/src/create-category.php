<?php

use Vidamrr\Gastos\model\Category;

if (isset($_POST['name'])) {
    $name = $_POST['name'];

    if (!Category::exists($name)) {
        $category = new Category($name);
        $category->save();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create category</title>
    <link rel="stylesheet" href="src/main.css">
</head>

<body>
    <nav>
        <ul>
            <li><a href="?view=home">Home</a></li>
            <li><a href="?view=create-expense">Create expense</a></li>
            <li><a href="?view=create-category">Create categories</a></li>
        </ul>
    </nav>
    <div class="container">
        <form action="?view=create-category" method="POST">
            <input type="text" name="name" placeholder="Name">
            <input type="submit" value="Create category" />
        </form>

        <div class="categories">
            <?php
            $categories = Category::getAll();

            foreach ($categories as $category) {
                echo "<div class='category'>{$category->getName()}</div>";
            }
            ?>
        </div>
    </div>
</body>

</html>