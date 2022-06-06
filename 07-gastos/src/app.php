<?php


if (isset($_GET['view'])) {
    $view = $_GET['view'];

    require $view . '.php';
}
