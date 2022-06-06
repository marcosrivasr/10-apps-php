<?php

use Vidamrr\Gastos\model\Expense;
use Vidamrr\Gastos\model\Category;

if (isset($_POST['title']) && isset($_POST['expense']) && isset($_POST['category_id'])) {
    $title = $_POST['title'];
    $expense = $_POST['expense'];
    $categoryId = $_POST['category_id'];

    $expense = new Expense($title, $categoryId, $expense);
    $expense->save();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create expense</title>
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
        <form action="?view=create-expense" method="POST">
            <input type="text" name="title" placeholder="Name">
            <input type="number" name="expense" placeholder="Expense">
            <select name="category_id" id="">
                <?php
                $categories = Category::getAll();

                foreach ($categories as $category) {
                    echo "<option value='{$category->getId()}'>{$category->getName()}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Create expense">
        </form>
    </div>
</body>

</html>