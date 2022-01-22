<?php

use app\controllers\BookController;
use app\core\Application;

require_once __DIR__ . "/../vendor/autoload.php";


$config = [
    "tableName" => "books",
    "dbName" => "crud_app"
];


$app = new Application($config);


$app->router->get("/", [new BookController(), "index"]);
$app->router->get("/create", [new BookController(), "create"]);
$app->router->post("/create", [new BookController(), "create"]);
$app->router->post("/delete", [new BookController(), "delete"]);
$app->router->get("/update", [new BookController(), "update"]);
$app->router->post("/update", [new BookController(), "update"]);

echo $app->run();



?>