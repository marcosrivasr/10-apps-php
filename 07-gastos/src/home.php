<?php

use Vidamrr\Gastos\model\Expense;

$expenses = Expense::getAll();
$total = Expense::getTotal($expenses);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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

        <div class="expenses">

            <div>Total: $<?php echo $total; ?></div>
            <?php

            foreach ($expenses as $expense) {
                echo "<div class='expense'><div>{$expense->getTitle()}</div><div>{$expense->getCategory()->getName()}</div><div>$ {$expense->getExpense()}</div></div>";
            }
            ?>
        </div>
    </div>
</body>

</html>