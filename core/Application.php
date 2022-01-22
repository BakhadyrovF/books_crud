<?php


namespace app\core;

use app\core\form\Form;

class Application 
{
    public static Application $app;
    public Router $router;
    public Request $request;
    public Database $db;
    public Form $form;

    public function __construct($config)
    {
        self::$app = $this;
        $this->request = new Request();
        $this->db = new Database($config);
        $this->form = new Form();
        $this->router = new Router($this->request);
    }

    public function run()
    {
        return $this->router->resolve();
    }
}



















?>