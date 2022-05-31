<?php

namespace Vidamrr\Blog\utils;

use Vidamrr\Blog\utils\Url;

class Post
{

    public function __construct(private string $file)
    {
    }

    public function getContent()
    {
        $stream = fopen($this->getFileName(), "r");
        $content = fread($stream, filesize($this->getFileName()));

        return $content;
        fclose($stream);
    }

    public function getUrl()
    {
        $url = substr($this->file, 0, strpos($this->file, '.md'));
        return 'http://localhost/10-apps-php/02-blob/?post=' . $url;
    }

    public function getTitle()
    {
        $url = substr($this->file, 0, strpos($this->file, '.md'));
        $title = str_replace('-', ' ', $url);
        return $title;
    }

    private function getFileName()
    {
        $srcDir = Url::getRootPath();
        $fileName = "{$srcDir}/blog/entries/{$this->file}";
        error_log("****** {$fileName}");
        return $fileName;
    }

    public static function findPost(string $name)
    {
        $file = str_replace('  ', '-', $name) . '.md';
        $post = new Post($file);
        return $post;
    }
}
