<?php

namespace app\core;



class Request
{
    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getBody()
    {
        return $_POST;
    }

    public function getPath()
    {
        return $_SERVER["PATH_INFO"] ?? "/";
    }
}







?>