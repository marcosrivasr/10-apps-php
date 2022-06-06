<?php

namespace Vidamrr\Gastos\model;

use Vidamrr\Gastos\lib\Database;
use Vidamrr\Gastos\model\Category;
use PDO;

class Expense extends Database
{

    private string $categoryName;
    private string $date;
    private Category $category;

    public function __construct(private string $title, private string $categoryId, private string $expense)
    {
        parent::__construct();
    }

    public function save()
    {
        $query = $this->connect()->prepare('INSERT INTO expenses(title, category_id, expense, date) VALUES(:title, :category_id, :expense, now())');
        $query->execute(['title' => $this->title, 'category_id' => $this->categoryId, 'expense' => $this->expense]);
    }

    public static function getAll()
    {
        $db = new Database();
        $query = $db->connect()->query('SELECT * FROM expenses INNER JOIN categories ON expenses.category_id = categories.id');

        $expenses = [];
        while ($r = $query->fetch(PDO::FETCH_ASSOC)) {
            $expense = Expense::createFromArray($r);
            array_push($expenses, $expense);
        }

        return $expenses;
    }

    public static function createFromArray($arr)
    {
        $expense = new Expense($arr['title'], $arr['category_id'], $arr['expense'], $arr['date']);
        $expense->setCategoryName($arr['name']);
        $expense->setDate($arr['date']);
        $expense->setCategory(Category::get($expense->getCategoryId()));

        return $expense;
    }

    public static function getTotal($expenses)
    {
        $total = 0;
        foreach ($expenses as $expense) {
            $total = $total + $expense->getExpense();
        }

        return $total;
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getExpense()
    {
        return $this->expense;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setDate($value)
    {
        $this->date = $value;
    }

    public function setCategoryName($value)
    {
        $this->categoryName = $value;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($value)
    {
        $this->category = $value;
    }
}
