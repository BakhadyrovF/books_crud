<?php

namespace app\core;

use app\models\BookModel;
use app\models\CreateModel;
use PDO;

abstract class Model 
{
    public const RULE_REQUIRED = "required";
    public const RULE_UNIQUE = "unique";
    public array $errors = [];
    public array $books = [];


    abstract public function rules();

    public function loadData($data)
    {
        foreach($data as $key => $value)
        {
            if(property_exists(new BookModel(), $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach($rules as $rule)
            {
                $ruleName = $rule;

                if($ruleName === self::RULE_REQUIRED && empty($value))
                {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }

                if($ruleName === self::RULE_UNIQUE && $this->fetchByTitle($value))
                {
                    $this->addError($attribute, self::RULE_UNIQUE);
                }
            }
        }
        return empty($this->errors);
    }

    public function save($data)
    {
        $pdo = Application::$app->db->pdo;
        $statement = $pdo->prepare("INSERT INTO books (title, author, price) VALUES (:title, :author, :price)");
        foreach($data as $attribute => $value)
        {
            $statement->bindValue(":$attribute", $value);
        }
        return $statement->execute();
    }

    

    public function addError($attribute, $ruleName)
    {
        $message = $this->errorMessages()[$ruleName];
        $this->errors[$attribute][] = $message;  
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => "This field is required!",
            self::RULE_UNIQUE => "This title is already exists!"
        ];
    }

    public function fetchByTitle($value)
    {
        if(Application::$app->request->getPath() === "/create")
        {
            $pdo = Application::$app->db->pdo;
            $statement = $pdo->prepare("SELECT title FROM books WHERE title = :title");
            $statement->bindValue(":title", $value);
            $statement->execute();
            $user = $statement->fetchObject();
            return $user ?? false;
        }
    }

    public function getBooks()
    {
        $statement = $this->prepare("SELECT * FROM books");
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->books = $books;
        
    }

    public function delete($id)
    {
        $statement = $this->prepare("DELETE FROM books WHERE id = $id");
        $statement->execute();

    }

    public function update($id)
    {
        $statement = $this->prepare("UPDATE books SET title = :title, author = :author, price = :price WHERE id = $id");
        $statement->bindValue(":title", $this->title);
        $statement->bindValue(":author", $this->author);
        $statement->bindValue(":price", $this->price);
        $statement->execute();
        
    }

    public function fetchById($id)
    {
        $statement = $this->prepare("SELECT * FROM books WHERE id = $id");
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            $this->title = $user["title"];
            $this->author = $user["author"];
            $this->price = $user["price"];
        }
        
    }

    public function orderByTitle($title)
    {
        $title = "%" . $title ."%";
        $statement = Application::$app->db->pdo->prepare("SELECT * FROM books WHERE title LIKE :title");
        $statement->bindValue(':title', $title);
        $statement->execute();
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->books = $user;
    
        
        
        
    }

    public function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}










?>