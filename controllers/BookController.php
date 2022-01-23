<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\BookModel;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $_GET["search"] ?? null;
        $createModel = new BookModel();
        $createModel->getBooks();
        $createModel->orderByTitle($search);
        return $this->render("index", [
            "model" => $createModel,
            "search" => $search
        ]);
        
    }

    public function create(Request $request)
    {
        $createModel = new BookModel();
        if($request->getMethod() === "post")
        {
            $createModel->loadData($request->getBody());
            
            if($createModel->validate())
            {
                $createModel->save($request->getBody());
                header("Location: /");
            }

        }
        return $this->render("create", [
            "model" => $createModel
        ]);
    }

    public function update(Request $request)
    {
        $createModel = new BookModel();
        $id = $_GET["id"] ?? null;
        if($request->getMethod() === "post")
        {
            $createModel->loadData($request->getBody());
            
            if($createModel->validate())
            {
                $createModel->update($id);
                header("Location: /");
            }
        }
        $createModel->fetchById($id);
        return $this->render("update", [
            "model" => $createModel
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->getBody()["id"];
        $createModel = new BookModel();
        $createModel->delete($id);
        header("Location: /");
    }

}











?>