<?php

use Vidamrr\Poll\model\Poll;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $poll = Poll::find($id);

    if (isset($_POST['option_id'])) {
        $optionId = $_POST['option_id'];
        $poll = $poll->vote($optionId);
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
    <title>Vote</title>
    <link rel="stylesheet" href="src/resources/main.css">
</head>

<body>
    <div class="container">

        <h1><?php echo $poll->getTitle(); ?></h1>
        <h3>Total votes: <?php echo $poll->getTotalVotes(); ?></h3>
        <?php

        foreach ($poll->getOptions() as $option) {
            if ($poll->getTotalVotes() === 0) {
                $percentage = 0;
            } else {
                $percentage  = number_format(($option['votes'] / $poll->getTotalVotes()) * 100, 2);
            }
        ?>
            <div class="vote-item">
                <div class="bar" style="width:<?php echo $percentage ?>%"></div>
                <div class="vote-info">
                    <form action="?view=view&id=<?php echo $id; ?>" method='POST'>
                        <input type='hidden' name='option_id' value="<?php echo $option['id'] ?>" />
                        <button class="button">Vote for <?php echo "{$option['title']}" ?></button>
                    </form>

                    <div>
                        <?php echo "{$option['votes']}" ?> votes
                    </div>

                    <div>
                        <?php echo $percentage ?>%
                    </div>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

</body>

</html>