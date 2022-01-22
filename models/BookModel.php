<?php

namespace app\models;

use app\core\Model;

class BookModel extends Model
{
    public string $title = "";
    public string $author = "";
    public $price = "";

    public function rules()
    {
        return [
            "title" => [self::RULE_REQUIRED, self::RULE_UNIQUE],
            "author" => [self::RULE_REQUIRED],
            "price" => [self::RULE_REQUIRED]
        ];
    }

    
}




?>