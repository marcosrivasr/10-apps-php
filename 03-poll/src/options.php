<?php

use Vidamrr\Poll\model\Poll;


if (isset($_POST['title']) && isset($_POST['end_date'])) {

    if (isset($_POST['option']) && is_array($_POST["option"])) {
        $title = $_POST['title'];
        $endDate = $_POST['end_date'];
        $options = $_POST['option'];

        $poll = new Poll($title, $endDate);

        $poll->save();
        $poll->insertOptions($options);

        header('Location: http://localhost/10-apps-php/03-poll');
    }
} else {
    header('Location: http://localhost/10-apps-php/03-poll');
}

?>

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
        <form action="?view=options" method="POST">
            <h2>Questions</h2>
            <input type="hidden" name="title" value="<?php echo $_POST['title'] ?>">
            <input type="hidden" name="end_date" value="<?php echo $_POST['end_date'] ?>">

            <input type="text" name="option[]" placeholder="Option" class="input">
            <input type="text" name="option[]" placeholder="Option" class="input">

            <div id="more-inputs"></div>
            <button id="bAdd" class="button-add">Add another option</button>
            <input type="submit" value="Create poll" class="button">
        </form>
    </div>

    <script>
        const bAdd = document.querySelector('#bAdd');
        const container = document.querySelector('#more-inputs');

        bAdd.addEventListener('click', e => {
            e.preventDefault();
            const wrapper = document.createElement('div');
            wrapper.classList.add('wrapper');

            const bDelete = document.createElement('button');
            bDelete.value = 'Delete';
            bDelete.append('Delete');
            bDelete.addEventListener('click', e => {
                e.preventDefault();
                wrapper.remove();
            });


            const input = document.createElement('input');
            input.name = 'option[]';
            input.type = 'text';
            input.id = crypto.randomUUID();
            input.classList.add('input');
            input.placeholder = 'Option';

            wrapper.appendChild(input);
            wrapper.appendChild(bDelete);
            container.appendChild(wrapper);
        });
    </script>
</body>

</html>