<?php

use Vidamrr\Readme\model\Readme;
use Vidamrr\Readme\model\Validator;

$readme = null;

if (count($_POST) > 0) {

    $readme = new Readme($_POST);
    $readme->generate();
}

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
    <form action="?view=home" method="POST">
        <details>
            <summary>Title</summary>
            <div>
                <input name="title" value="<?php echo Validator::getValue($readme, 'getTitle') ?>" />
            </div>
        </details>
        <details>
            <summary>Description</summary>
            <div>
                <input name="description" value="<?php echo Validator::getValue($readme, 'getDescription') ?>" />
            </div>
        </details>
        <details>
            <summary>Authors</summary>
            <div id="authors">
                <?php
                $authors = Validator::getValue($readme, 'getAuthors');
                if (is_array($authors)) {

                    foreach ($authors as $author) {
                ?>
                        <div class="author">
                            <input name="authors[]" value="<?php echo $author['author'] ?>" /><input type="url" name="links[]" value="<?php echo $author['link'] ?>" />
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <div class="author">
                        <input name="authors[]" /><input type="url" name="links[]" />
                    </div>
                <?php
                }
                ?>
            </div>
            <button id="bAddAuthor">Add another author</button>
        </details>

        <details>
            <summary>Contribute</summary>
            <div>
                <input name="contribute" value="" />
            </div>
        </details>

        <details>
            <summary>FAQ</summary>
            <div>
                <input name="faq" value="" />
            </div>
        </details>

        <details>
            <summary>Installation/steps</summary>
            <div id="steps">
                <?php
                $steps = Validator::getValue($readme, 'getInstallation');
                print_r($steps);
                if (is_array($steps)) {

                    foreach ($steps as $step) {
                ?>
                        <div class="step">
                            <input name="steps[]" value="<?php echo $step['step'] ?>" /><input type="text" name="codes[]" value="<?php echo $step['code'] ?>" />
                        </div>

                    <?php
                    }
                } else {
                    ?>
                    <div class="step">
                        <input name="steps[]" /><input type="text" name="codes[]" />
                    </div>
                <?php
                }
                ?>
            </div>
            <button id="bAddInstallation">Add another step</button>
        </details>

        <input type="submit" value="Generate README" />
    </form>

    <div class="markdown">
        <pre><code><?php
                    if (isset($readme)) {
                        echo $readme->getMarkdown();
                    }
                    ?>
            </code>
        </pre>
    </div>

    <div class="preview">
        <?php
        if (isset($readme)) {
            echo $readme->getHTML();
        }
        ?>
    </div>

    <script>
        const bAddAuthor = document.querySelector('#bAddAuthor');

        bAddAuthor.addEventListener('click', e => {
            e.preventDefault();
            const authorDiv = document.createElement('div');
            authorDiv.classList.add('author');

            const inputName = document.createElement('input');
            inputName.name = 'authors[]';
            inputName.required = true;

            const inputURL = document.createElement('input');
            inputURL.type = 'url';
            inputURL.name = 'links[]';
            inputURL.required = true;

            authorDiv.appendChild(inputName);
            authorDiv.appendChild(inputURL);
            document.querySelector('#authors').append(authorDiv);
        });

        const bAddInstallation = document.querySelector('#bAddInstallation');

        bAddInstallation.addEventListener('click', e => {
            e.preventDefault();
            const authorDiv = document.createElement('div');
            authorDiv.classList.add('step');

            const inputName = document.createElement('input');
            inputName.name = 'steps[]';
            inputName.required = true;

            const inputURL = document.createElement('input');
            inputURL.name = 'codes[]';
            inputURL.required = true;

            authorDiv.appendChild(inputName);
            authorDiv.appendChild(inputURL);
            document.querySelector('#steps').append(authorDiv);
        });
    </script>
</body>

</html>