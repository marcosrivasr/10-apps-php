<?php

namespace Vidamrr\Suggestions\model;

use PDO;

class Suggestion extends Database
{

    public static function saveSearch($q)
    {
        $db = new Database();

        $words = explode(' ', $q);

        foreach ($words as $word) {
            if ($word !== 'de' || $word !== 'el' || $word !== 'a') {
                $query = $db->connect()->prepare('INSERT INTO search(q, session_id) VALUES(:q, :id)');
                $query->execute(['q' => $word, 'id' => $_SESSION['session_id']]);
            }
        }
    }

    public static function getSuggestions()
    {
        $ids = [];
        $res = [];
        $db = new Database();

        $query = $db->connect()->prepare("SELECT * FROM search JOIN products ON products.categories LIKE concat('%',search.q, '%') WHERE session_id = :id LIMIT 0,10");
        $query->execute(['id' => $_SESSION['session_id']]);

        $r = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($r as $suggestion) {
            if (!array_search($suggestion['id'], $ids)) {
                array_push($ids, $suggestion['id']);
                array_push($res, $suggestion);
            }
        }

        return $res;
    }
}
