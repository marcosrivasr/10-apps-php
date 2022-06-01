<?php


if (isset($_GET['view'])) {
    $view = $_GET['view'];

    switch ($view) {
        case 'create':
            require 'create.php';
            return;
        case 'options':
            require 'options.php';
            return;
        case 'view':
            require 'view.php';
            return;
    }
} else {
    require 'home.php';
}
