<?php

use Vidamrr\Comments\model\Comment;

$params = explode('&', $_SERVER['QUERY_STRING']);

$url = '';
foreach ($params as $param) {
    if (strpos($param, 'post=') === 0) {
        $url = explode('=', $param)[1];
    }
}


if (isset($_POST['username']) && isset($_POST['text']) && $url !== '') {
    $username = $_POST['username'];
    $text = $_POST['text'];

    $comment = new Comment($username, $text, $url);
    $comment->save();
}
