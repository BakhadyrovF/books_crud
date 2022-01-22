<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getField($attribute)
    {
        echo sprintf('<div class="input-body">
        <label class="form-label">%s *</label>
        <input type="%s"  %s name="%s" value="%s" class="form-control %s" placeholder="%s">
        <div class="error-message">%s</div>
      </div>', $this->getAttributes()[$attribute], $this->checkType($attribute), $this->minMax($attribute), $attribute, $this->model->{$attribute}, $this->hasError($attribute) ? "is-invalid" : "", $this->placeHolder($attribute) , $this->getFirstError($attribute));
    }

    
    public function hasError($attribute)
    {
        return $this->model->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->model->errors[$attribute][0] ?? "";
    }

    public function getAttributes()
    {
        return [
            "title" => "Title",
            "author" => "Author",
            "price" => "Price"
        ];
    }

    public function placeHolder($attribute)
    {
        return $attribute === "price" ? '$' : false;
    }

    public function checkType($attribute)
    {
        return ($attribute === "price") ? "number" : "text";
    }

    public function minMax($attribute)
    {
        return ($attribute === "price") ? 'min="0" step="1"' : "";
    }
}







?>