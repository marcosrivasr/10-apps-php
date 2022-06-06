<?php

use Vidamrr\Formulario\model\Validator;

if (count($_POST) > 0) {
    $v = new Validator($_POST['name']);

    $v
        ->minLen(5)
        ->isEmail()
        ->contains(['luis']);

    print_r($v->getErrors());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="name">
    </form>
</body>

</html>