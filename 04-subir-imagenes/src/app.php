<?php

if (isset($_GET['view'])) {
    $view = $_GET['view'];

    switch ($view) {
        case 'home':
            require 'home.php';
            break;
        case 'upload':
            require 'upload.php';
            break;
        case 'view':
            require 'view.php';
            break;
        default:
    }
} else {
    require 'home.php';
}
