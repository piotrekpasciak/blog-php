<?php

require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../models/Post.php';
require_once __DIR__.'/../models/Comment.php';

class HomeController extends Controller
{
    public function indexAction($page = 1, $category_name = "")
    {
        $data = [];
        $category = new Category;
        $post = new Post;

        $data["user"] = $this->current_user();
        $data["categories"] = $category->index()->fetchAll();
        $count = $post->count($category_name)->fetch()[0];
        $data["pages"] = ($count % 5 > 0) ? floor($count / 5 + 1) : floor($count / 5);
        $data["category"] = $category_name;
        $data["posts"] = $post->filter($page, $category_name)->fetchAll();

        $this->view('home/index', $data, 'layout');
    }

    public function showAction($id = 1, $page = 1)
    {
        $data = [];
        $data["user"] = $this->current_user();

        if(isset($_SESSION['success'])){
            $data['success'] =  $_SESSION['success'];
            unset($_SESSION['success']);
        }

        if(isset($_SESSION['error'])){
            $data['error'] =  $_SESSION['error'];
            unset($_SESSION['error']);
        }

        $post = new Post;
        $comment = new Comment;

        $data["post"] = $post->show($id)->fetch(PDO::FETCH_ASSOC);
        $data["comments"] = $comment->filter($data["post"]["ID"], $page)->fetchAll();

        $this->view('home/show', $data, 'layout');
    }

    public function imagesAction()
    {
        $data = [];
        $this->view('home/images', $data, 'layout');
    }

    public function databaseAction()
    {
        $data = [];
        $this->view('home/database', $data, 'layout');
    }

    public function csrfAction()
    {
        $data = [];
        $this->view('home/csrf', $data, 'layout');
    }

    public function testAction()
    {
        $data = [];
        $this->view('home/test', $data, 'layout');
    }

    public function cookieAction()
    {
        $data = [];
        $this->view('home/cookie', $data, 'layout');
    }
}