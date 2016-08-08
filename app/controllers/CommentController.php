<?php

require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../models/Post.php';
require_once __DIR__.'/../models/Comment.php';

class CommentController extends Controller
{
    public function createAction($post_id = 0)
    {
        session_start();

        if($this->validate_id($post_id))
        {
            if(!empty($_POST))
            {
                $text = $_POST["text"];

                if(empty($text))
                {
                    $error = "Comment cannot be empty!";
                }
                else
                {
                    $comment = new Comment($text, $post_id);
                    $result = $comment->create();

                    if($result)
                    {
                        $success = "You have successfully created new comment!";
                    }
                    else
                    {
                        $error = "Comment couldn't be created!";
                    }
                }

                if(!empty($success))
                {
                    $_SESSION['succes'] = $success;
                }
                else if(!empty($error))
                {
                    $_SESSION['error'] = $error;
                }

            }
            $this->redirect('/home/show/' . $post_id);
        }
    }
}