<?php

if (isset($_GET['view'])) {
    $view = $_GET['view'];

    require 'src/' . $view . '.php';
} else {
    require 'src/home.php';
}
