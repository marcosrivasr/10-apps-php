<?php

if (isset($_GET['post'])) {
    require 'post/index.php';
} else {
    require 'home.php';
}
