<?php


if (isset($_GET['view'])) {
    $view = $_GET['view'];

    require 'views/' . $view . '.php';
} else {
    require 'views/home.php';
}
