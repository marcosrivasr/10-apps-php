<?php

namespace Notas\models;

use PDO;
use Notas\lib\Database;

class Note extends Database
{
    private string $uuid;

    public function __construct(private string $title, private string $content, private string $updatedAt)
    {
        parent::__construct();
        $this->uuid = uniqid();
    }

    static function createFromArray($arr)
    {
        $note = new Note($arr['title'], $arr['content'], $arr['updated_at'] ?? date(DATE_RSS));
        $note->setUUID($arr['uuid'] ?? uniqid());

        return $note;
    }

    public function updateFromArray($arr)
    {
        if (isset($arr['title'])) {
            $this->setTitle($arr['title']);
        }

        if (isset($arr['content'])) {
            $this->setContent($arr['content']);
        }

        $this->setUpdatedAt();

        return $this;
    }

    static function getNote($id)
    {
        $db = new Database();
        $query = $db->connect()->prepare("SELECT * FROM notas WHERE uuid = :id");
        $query->execute(['id' => $id]);

        return Note::createFromArray($query->fetch(PDO::FETCH_ASSOC));
    }

    public function save()
    {
        $query = $this->connect()->prepare("UPDATE notas SET title = :title, content = :content WHERE uuid = :id");
        $res = $query->execute(['id' => $this->getUUID(), 'title' => $this->getTitle(), 'content' => $this->getContent()]);
    }

    public function setTitle($value)
    {
        $this->title = $value;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt()
    {
        $this->updatedAt = date(DATE_RSS);
    }

    public function getContent(): string
    {
        return $this->content;
    }
    public function setContent($value)
    {
        $this->content = $value;
    }

    public function getUUID(): string
    {
        return $this->uuid;
    }

    public function setUUID($value)
    {
        $this->uuid = $value;
    }
}
