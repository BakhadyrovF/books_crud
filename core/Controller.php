<?php

namespace app\core;



class Controller 
{
    public function render($view, $params = [])
    {
        return Application::$app->router->render($view, $params);
    }

}





?>