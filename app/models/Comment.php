<?php

class Comment extends Database
{
    private $text;
    private $created_at;
    private $post_id;
    private $user_id;
    private $page_limit = 5;

    function __construct($text = '', $post_id = 0)
    {
        parent::__construct();

        $this->text = $text;
        $this->post_id = $post_id;

        if (isset($_SESSION['user'])) {
            $this->user_id = $_SESSION['user']['ID'];
        }
        else
        {
            $this->user_id = "NULL";
        }
        $this->created_at = date('Y-m-d-H-i-s');
    }

    function filter($post_id, $page)
    {
        $post_numbers = $this->page_limit * ($page - 1);
        return $this->connection->query("SELECT comments.TEXT, comments.CREATED_AT, comments.POST_ID, users.USERNAME FROM comments LEFT JOIN users ON comments.USER_ID = users.ID WHERE comments.POST_ID = " . $post_id . " ORDER BY comments.ID DESC LIMIT " . $post_numbers . ",5");
    }

    function create()
    {
        if(empty($this->text) || $this->post_id === 0 || empty($this->created_at)){
            return false;
        }
        else
        {
            return $this->connection->query("INSERT INTO comments(text, created_at, post_id, user_id) VALUES
            ('" . $this->text . "', '" . $this->created_at. "', '" . $this->post_id. "', '" . $this->user_id ."')");
        }
    }
}