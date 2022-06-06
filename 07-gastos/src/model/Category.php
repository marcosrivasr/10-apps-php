<?php

namespace Vidamrr\Gastos\model;

use Vidamrr\Gastos\lib\Database;
use PDO;

class Category extends Database
{
    private int $id;

    public function __construct(private string $name)
    {
        parent::__construct();
    }

    public function save()
    {
        $query = $this->connect()->prepare('INSERT INTO categories(name) VALUES(:name)');
        $query->execute(['name' => $this->name]);
    }

    public static function getAll()
    {
        $db = new Database();
        $query = $db->connect()->query('SELECT * FROM categories');

        $categories = [];
        while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
            $category = Category::createFromArray($r);
            array_push($categories, $category);
        }

        return $categories;
    }

    public static function get($id)
    {
        $db = new Database();
        $query = $db->connect()->prepare('SELECT * FROM categories WHERE id=:id');
        $query->execute(['id' => $id]);

        $r = $query->fetch(PDO::FETCH_ASSOC);
        $category = Category::createFromArray($r);

        return $category;
    }

    public static function exists($name)
    {
        $db = new Database();
        $query = $db->connect()->prepare('SELECT * FROM categories WHERE name = :name');
        $query->execute(['name' => $name]);

        return $query->rowCount() > 0;
    }

    public static function createFromArray($arr)
    {
        $category = new Category($arr['name']);
        $category->id = $arr['id'];
        return $category;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }
}
