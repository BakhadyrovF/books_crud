<?php


namespace app\core;



class Router 
{
    public array $routes = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
        
    }

    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }
   
    public function resolve()
    {

        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $callback = $this->routes[$method][$path] ?? false;
        
        if(!$callback)
        {
            echo "404 page not found!";
            exit;
        }


        return call_user_func($callback, $this->request);
    }

    public function render($view, $params = [])
    {
        $layout = $this->renderLayout($params);
        $viewContent = $this->renderView($view, $params);
        return str_replace("{{content}}", $viewContent, $layout);


    }

    public function renderLayout($params = [])
    {
        ob_start();
        include_once __DIR__ . "/../views/layouts/main.php";
        return ob_get_clean();
    }

    public function renderView($view, $params = [])
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }

        ob_start();
        include_once __DIR__ . "/../views/$view.php";
        return ob_get_clean();
    }

}



?>