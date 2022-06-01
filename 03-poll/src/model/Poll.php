<?php

namespace Vidamrr\Poll\model;

use PDO;
use Vidamrr\Poll\utils\Database;

class Poll extends Database
{
    private int $id;
    private string $uuid;
    private array $options = [];

    public function __construct(private string $title, private string $endDate, $createUUID = true)
    {
        parent::__construct();
        if ($createUUID) {
            $this->uuid = uniqid();
        }
    }

    public function save()
    {
        $query = $this->connect()->prepare('INSERT INTO polls(uuid, title, end_date) VALUES(:uuid, :title, :end_date)');
        $query->execute(['uuid' => $this->uuid, 'title' => $this->title, 'end_date' => $this->endDate]);

        $query = $this->connect()->prepare('SELECT * FROM polls WHERE uuid = :uuid');
        $query->execute(['uuid' => $this->uuid]);

        $this->id = $query->fetchColumn();
        //error_log('***' . $query->fetchColumn());
    }

    public function insertOptions($options)
    {
        foreach ($options as $option) {
            $query = $this->connect()->prepare('INSERT INTO options(poll_id, title, votes) VALUES(:poll_id, :title, :votes)');
            $query->execute(['poll_id' => $this->id, 'title' => $option, 'votes' => 0]);
        }
    }

    public static function getPolls()
    {
        $db = new Database();
        $query = $db->connect()->query('SELECT * FROM polls');

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createFromArray($arr)
    {
        $poll = new Poll($arr['title'], $arr['end_date'], false);
        $poll->setUUID($arr['uuid']);
        return $poll;
    }

    public static function find($uuid)
    {
        $db = new Database();

        $query = $db->connect()->prepare('SELECT * FROM polls WHERE uuid = :uuid');
        $query->execute(['uuid' => $uuid]);
        $r = $query->fetch();
        $poll = Poll::createFromArray($r);

        $query = $db->connect()->prepare('SELECT polls.id as p_id, polls.uuid as p_uuid, polls.title as p_title, polls.end_date as p_end_date, options.id as o_id, options.title as o_title, options.votes as o_votes FROM polls INNER JOIN options ON polls.id = options.poll_id WHERE polls.uuid = :uuid');
        $query->execute(['uuid' => $uuid]);


        while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
            $poll->includeOption(['id' => $r['o_id'], 'title' => $r['o_title'], 'votes' => $r['o_votes']]);
        }

        return $poll;
    }

    public function includeOption($arr)
    {
        array_push($this->options, $arr);
    }

    public function vote($optionId)
    {
        $query = $this->connect()->prepare('UPDATE options SET votes = votes + 1 WHERE id = :id');
        $query->execute(['id' => $optionId]);

        $poll = Poll::find($this->getUUID());
        return $poll;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getUUID()
    {
        return $this->uuid;
    }

    public function setUUID($value)
    {
        $this->uuid = $value;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getTotalVotes()
    {
        $total = 0;
        foreach ($this->options as $option) {
            $total = $total + $option['votes'];
        }

        return $total;
    }
}
