<?php
ini_set('session.use_strict_mode', 1);

session_start();
if (isset($_SESSION['session_id'])) {
    echo $_SESSION['session_id'];
} else {
    $newid = session_create_id();
    $_SESSION['session_id'] = $newid;
    echo $newid;
}

require 'vendor/autoload.php';
require 'src/app.php';
