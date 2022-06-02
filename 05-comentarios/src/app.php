<?php


if (isset($_GET['post'])) {
    $post = $_GET['post'];

    require 'src/' . $post . '.php';
}
