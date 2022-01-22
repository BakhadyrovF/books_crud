<?php

namespace app\core\form;

use app\core\Model;

class Form 
{
    public function begin($action, $method)
    {
        echo sprintf('<form autocomplete="off" style="margin-top: 20px;" action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public function end()
    {
        echo "</form>";
    }

    public function field($attribute, Model $model)
    {
        $field = new Field($model);
        return $field->getField($attribute);
    }

    
}




?>