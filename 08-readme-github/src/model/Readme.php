<?php

namespace Vidamrr\Readme\model;

use League\CommonMark\CommonMarkConverter;
use Vidamrr\Readme\model\Validator;

class Readme
{

    private string $title;
    private string $description;
    private array $authors;
    private array $authorLinks;
    private string $contribute;
    private string $faq;
    private array $steps;
    private array $codes;

    private CommonMarkConverter $converter;

    private string $markdown;

    public function __construct($arr)
    {
        $this->converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $this->title = Validator::get($arr, 'title');
        $this->description = Validator::get($arr, 'description');

        $this->authors = Validator::getArray($arr, 'authors');
        $this->authorLinks = Validator::getArray($arr, 'links');

        $this->steps = Validator::getArray($arr, 'steps');
        $this->codes = Validator::getArray($arr, 'codes');

        $this->contribute = Validator::get($arr, 'contribute');
        $this->faq = Validator::get($arr, 'faq');
    }

    public function generate()
    {
        $this->markdown = '';
        $this->markdown .= $this->createMarkdown('title', $this->title);
        $this->markdown .= $this->createMarkdown('description', $this->description);
        $this->markdown .= $this->createMarkdown('installation', ['steps' => $this->steps, 'codes' => $this->codes]);
        $this->markdown .= $this->createMarkdown('authors', ['authors' => $this->authors, 'links' => $this->authorLinks]);
        $this->markdown .= $this->createMarkdown('contribute', $this->contribute);
        $this->markdown .= $this->createMarkdown('faq', $this->faq);
    }

    public function getMarkdown()
    {
        return nl2br($this->markdown);
    }

    public function getHTML()
    {
        return $this->converter->convert($this->markdown);
    }

    private function createMarkdown($prop, $value)
    {
        if (is_null($value) || $value == '') {
            return '';
        }

        switch ($prop) {
            case 'title':
                return "# {$value} \n";
            case 'description':
                return "{$value} \n";
            case 'authors':
                return "{$this->processAuthors($value)} \n";
            case 'contribute':
                return "{$this->processContribute($value)} \n";
            case 'faq':
                return "{$this->processFAQ($value)} \n";
            case 'installation':
                return "{$this->processInstallation($value)} \n";
            default:
                return '';
        }
    }

    private function processAuthors($arr)
    {
        $mk = "## Authors \n";
        $authors = $arr['authors'];
        $links = $arr['links'];

        for ($i = 0; $i < count($authors); $i++) {
            $author = $authors[$i];
            $link = $links[$i];
            $mk .= "- [{$author}]({$link}) \n";
        }

        return $mk;
    }

    private function processInstallation($arr)
    {
        $mk = "## Installation / use \n";
        $steps = $arr['steps'];
        $codes = $arr['codes'];

        for ($i = 0; $i < count($steps); $i++) {
            $step = $steps[$i];
            $code = $codes[$i];

            $mk .= "{$step} \n";
            $mk .= "```bash \n";
            $mk .= "{$code} \n";
            $mk .= "``` \n";
        }

        return $mk;
    }

    private function processContribute($value)
    {
        $mk = "## Contribute \n";
        $mk .= $value;
        return $mk;
    }
    private function processFAQ($value)
    {
        $mk = "## FAQ \n";
        $mk .= $value;
        return $mk;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function getContribute()
    {
        return $this->contribute;
    }

    public function getAuthors()
    {
        $arr = [];
        $authors = $this->authors;
        $links = $this->authorLinks;

        for ($i = 0; $i < count($authors); $i++) {
            $author = $authors[$i];
            $link = $links[$i];
            $item = ['author' => $author, 'link' => $link];
            array_push($arr, $item);
        }

        return $arr;
    }

    public function getInstallation()
    {
        $arr = [];
        $steps = $this->steps;
        $codes = $this->codes;
        print_r($steps);

        for ($i = 0; $i < count($steps); $i++) {
            $step = $steps[$i];
            $code = $codes[$i];

            $item = ['step' => $step, 'code' => $code];
            array_push($arr, $item);
        }

        return $arr;
    }
}
