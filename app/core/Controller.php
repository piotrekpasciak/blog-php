<?php


class Controller
{
    public function index()
    {
        echo "This website doesn't exist";
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = [], $layout = 'layout')
    {
        require_once '../app/views/structure.php';
    }

    public function redirect($url, $permanent = false)
    {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

    public function unsafe_authenticate()
    {
        session_start();
        if(isset($_SESSION['user']))
        {
            return true;
        }
    }

    public function authenticate()
    {
        session_start();
        if(isset($_SESSION['user']) && $_SESSION["user"]["ROLE"] === 'Admin')
        {
            return true;
        }
        else if(isset($_SESSION['user']) && $_SESSION["user"]["ROLE"] === 'User')
        {
            $this->view('404', [] , 'empty_layout');
        }
        else
        {
            $error = "You have to login to continue!";
            $_SESSION['error'] = $error;

            $this->redirect("/user/login");
        }
    }

    public function current_user()
    {
        session_start();
        if (isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
    }

    public function validate_id($id)
    {
        if($id != 0 && ctype_digit($id))
        {
            return true;
        }
        else
        {
            $this->view('404', [] , 'empty_layout');
        }
    }
}

