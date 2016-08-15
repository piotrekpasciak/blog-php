<?php

require_once __DIR__.'/../models/Category.php';
require_once __DIR__.'/../models/Post.php';

class PostController extends Controller
{
    public function indexAction()
    {
        $data = [];

        if(isset($_SESSION['success']))
        {
            $data['success'] =  $_SESSION['success'];
            unset($_SESSION['success']);
        }

        if(isset($_SESSION['error']))
        {
            $data['error'] =  $_SESSION['error'];
            unset($_SESSION['error']);
        }

        if($this->authenticate())
        {
            $post = new Post;
            $posts = $post->index()->fetchAll();
            $data["posts"] = $posts;
            $this->view('post/index', $data , 'admin_layout');
        }
    }

    public function newAction()
    {
        if($this->authenticate())
        {
            $data = [];
            if(!empty($_POST))
            {
                $title = $_POST["title"];
                $category_id = $_POST["category"];
                $text = $_POST["text"];
                $image = '';
                $token = $_POST["token"];

                if($token !== $_SESSION['token'])
                {
                    $data['error'] = "This website was attacked by CSRF!";
                }
                else
                {
                    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))
                    {
                        $image = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_tmp = $_FILES['image']['tmp_name'];
                        $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
                        $extensions= array("jpeg","jpg","png");

                        if(in_array($file_ext, $extensions)=== false)
                        {
                            $error = "Only JPEG or PNG files are allowed!";
                        }

                        if($file_size > 20000097152)
                        {
                            $error = "File size can't be more then 200 MB!";
                        }

                        if(empty($error))
                        {
                            if(file_exists("images/upload/" . $image))
                            {
                                $image = substr($image, 0, -4) . "_" . date('Y-m-d-H-i-s') . "." . $file_ext;
                            }
                            move_uploaded_file($file_tmp, "images/upload/" . $image);
                        }
                    }
                    else
                    {
                        $image = "default_image.jpg";
                    }

                    if(empty($error))
                    {
                        if(empty($title) || empty($category_id) || empty($text))
                        {
                            $error = "Don't leave any of fields empty!";
                        }
                        else
                        {
                            $post = new Post($title, $text, $image, $category_id);
                            $result = $post->create();

                            if($result)
                            {
                                $success = "You have successfully created new post!";
                            }
                            else
                            {
                                $error = "Post couldn't be created!";
                            }
                        }

                        if(!empty($success))
                        {
                            $data = ["success" => $success];
                        }

                        else if(!empty($error))
                        {
                            $data = ["error" => $error];
                        }
                    }
                }
            }

            $token = md5(uniqid(rand(), TRUE));
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();

            $data['token'] = $token;
            $category = new Category;
            $categories = $category->index()->fetchAll();
            $data["categories"] = $categories;

            $this->view('post/new', $data , 'admin_layout');
        }
    }

    public function showAction($id)
    {
        $data = [];

        if($this->validate_id($id))
        {
            if ($this->authenticate())
            {
                $post = new Post;
                $post = $post->show($id)->fetch(PDO::FETCH_ASSOC);
                $data["post"] = $post;
                $this->view('post/show', $data, 'admin_layout');
            }
        }
    }



    public function editAction($id)
    {
        $data = [];

        if($this->validate_id($id))
        {
            if($this->authenticate())
            {
                if(!empty($_POST))
                {
                    $title = $_POST["title"];
                    $category_id = $_POST["category"];
                    $text = $_POST["text"];
                    $image = '';

                    if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))
                    {
                        $image = $_FILES['image']['name'];
                        $file_size = $_FILES['image']['size'];
                        $file_tmp = $_FILES['image']['tmp_name'];
                        $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
                        $extensions= array("jpeg","jpg","png");

                        if(in_array($file_ext, $extensions)=== false)
                        {
                            $error = "Only JPEG or PNG files are allowed!";
                        }

                        if($file_size > 20097152)
                        {
                            $error = "File size can't be more then 200 MB!";
                        }



                        if(empty($error))
                        {
                            if(file_exists("images/upload/" . $image))
                            {
                                $image = substr($image, 0, -4) . "_" . date('Y-m-d-H-i-s') . "." . $file_ext;
                            }

                            move_uploaded_file($file_tmp, "images/upload/" . $image);
                        }
                    }
                    else
                    {
                        $image = "default_image.jpg";
                    }

                    if(empty($error))
                    {
                        if(empty($title) || empty($category_id) || empty($text))
                        {
                            $error = "Don't leave any of fields empty!";
                        }

                        else
                        {
                            $post = new Post($title, $text, $image, $category_id);
                            $result = $post->update($id);

                            if($result)
                            {
                                $success = "You have successfully edited post!";
                            }
                            else
                            {
                                $error = "Post couldn't be edited!";
                            }
                        }

                        if(!empty($success))
                        {
                            $data = ["success" => $success];
                        }
                        else if(!empty($error))
                        {
                            $data = ["error" => $error];
                        }
                    }
                }

                $post = new Post;
                $post = $post->show($id)->fetch(PDO::FETCH_ASSOC);

                $category = new Category;
                $categories = $category->index()->fetchAll();

                $data["post"] = $post;
                $data["categories"] = $categories;

                $this->view('post/edit', $data, 'admin_layout');
            }
        }
    }

    public function deleteAction($id)
    {
        if($this->validate_id($id))
        {
            if($this->authenticate())
            {
                if(!empty($_POST)) {
                    $post = new Post;
                    $result = $post->delete($id);

                    if ($result)
                    {
                        $_SESSION['success'] = "You have successfully deleted post!";
                    }
                    else
                    {
                        $_SESSION['error'] = "This post doesn't exist";
                    }
                }
                $this->redirect("/post/index");
            }
        }
    }
}