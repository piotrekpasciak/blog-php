<?php



class Post extends Database

{

    private $title;

    private $text;

    private $image;

    private $category_id;



    private $user_id;

    private $created_at;



    private $page_limit = 5;



    function __construct($title = '', $text = '', $image = '', $category_id = 0) {

        parent::__construct();



        $this->title = $title;

        $this->text = $text;

        $this->image = $image;

        $this->category_id = $category_id;



        if(isset($_SESSION['user']))

        {

            $this->user_id = $_SESSION['user']['ID'];

        }



        $this->created_at = date('Y-m-d-H-i-s');

    }



    function count($category_name = '') {

        if(empty($category_name))

        {

            return $this->connection->query("SELECT COUNT(*) FROM posts");

        }

        else

        {

            return $this->connection->query("SELECT COUNT(*) FROM posts INNER JOIN categories ON posts.CATEGORY_ID = categories.ID WHERE categories.NAME = '" . $category_name . "'");

        }

    }



    function filter($page, $category_name = '') {



        $post_numbers = $this->page_limit * ($page - 1);



        if(empty($category_name))

        {

            return $this->connection->query("SELECT posts.ID, posts.TITLE, posts.TEXT, posts.IMAGE, posts.CREATED_AT, categories.NAME, users.USERNAME FROM posts INNER JOIN categories ON posts.CATEGORY_ID = categories.ID INNER JOIN users ON posts.USER_ID = users.ID ORDER BY ID DESC LIMIT " . 5 * ($page - 1) . ",5");

        }

        else

        {

            return $this->connection->query("SELECT posts.ID, posts.TITLE, posts.TEXT, posts.IMAGE, posts.CREATED_AT, categories.NAME, users.USERNAME FROM posts INNER JOIN categories ON posts.CATEGORY_ID = categories.ID INNER JOIN users ON posts.USER_ID = users.ID WHERE categories.NAME = '" . $category_name . "' ORDER BY ID DESC LIMIT " . 5 * ($page - 1) . ",5");

        }

    }



    function index() {

        return $this->connection->query("SELECT posts.ID, posts.TITLE, posts.TEXT, posts.IMAGE, posts.CREATED_AT, categories.NAME, users.USERNAME FROM posts INNER JOIN categories ON posts.CATEGORY_ID = categories.ID INNER JOIN users ON posts.USER_ID = users.ID ORDER BY ID DESC");

    }



    function show($id) {

        return $this->connection->query("SELECT posts.ID, posts.TITLE, posts.TEXT, posts.IMAGE, posts.CREATED_AT, categories.NAME, users.USERNAME FROM posts INNER JOIN categories ON posts.CATEGORY_ID = categories.ID INNER JOIN users ON posts.USER_ID = users.ID WHERE posts.ID = " . $id . "  ORDER BY ID DESC");

    }



    function create() {

        if(empty($this->title) || empty($this->text) || empty($this->image) || $this->category_id === 0 || $this->user_id === 0 || empty($this->created_at)){

            return false;

        }

        else

        {

            return $this->connection->query("INSERT INTO posts (title, text, image, created_at, category_id, user_id) VALUES ('" . $this->title . "','" . $this->text . "','" . $this->image . "','" . $this->created_at . "','" . $this->category_id . "','" . $this->user_id . "')");

        }

    }



    function update($id) {

        if(empty($this->title) || empty($this->text) || empty($this->image) || $this->category_id === 0 || $this->user_id === 0 || empty($this->created_at)){

            return false;

        }

        else

        {

            return $this->connection->query("UPDATE posts SET TITLE = '" . $this->title .  "', TEXT = '" . $this->text . "', IMAGE =  '" . $this->image . "', CATEGORY_ID = '" . $this->category_id . "', USER_ID = '" . $this->user_id . "'  WHERE id = " . $id);

        }

    }



    function delete($id) {

        return $this->connection->query("DELETE FROM posts WHERE id = " . $id);

    }

}



