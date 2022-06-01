<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>

<body>
    <div class="container">
        <form action="?view=options" method="POST">
            <label for="name">Name of the poll</label>
            <input type="text" name="title" class="input" required>

            <label for="end_date">End date</label>
            <input type="date" name="end_date" class="input" required>

            <input type="submit" value="Next" class="button">
        </form>
    </div>
</body>

</html>