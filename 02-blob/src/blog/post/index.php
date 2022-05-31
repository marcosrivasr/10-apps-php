<?php

use Vidamrr\Blog\utils\Post;

$url = $_GET['post'];

$post = Post::findPost($url);


require_once 'template.php';
