<?php

$view = $_GET['view'];

switch ($view) {
    case 'home':
        require_once 'home.php';
        return;

    case 'view':
        require_once 'view.php';
        return;

    case 'create':
        require_once 'create.php';
        return;
        break;

    default:
}
