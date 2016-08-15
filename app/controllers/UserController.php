<?php

require_once __DIR__.'/../models/User.php';

class UserController extends Controller
{
    public function indexAction()
    {
        echo 'user/index';
    }

    public function loginAction($data = [])
    {
        session_start();

        if(isset($_SESSION['success']))
        {
            $data = ['success' => $_SESSION['success']];
            unset($_SESSION['success']);
        }

        if(isset($_SESSION['error']))
        {
            $data = ['error' => $_SESSION['error']];
            unset($_SESSION['error']);
        }

        if(!empty($_POST))
        {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $error = '';

            if(empty($username) || empty($password))
            {
                $error = "Don't leave any of fields empty!";
            }
            else
            {
                $user = new User($username, $password);
                $is_blocked = $user->account_blocked();

                if(!$is_blocked)
                {
                    $result = $user->login()->fetch(PDO::FETCH_ASSOC);

                    if(!empty($result) && $result["ROLE"] === 'Admin')
                    {
                        $_SESSION['user'] = $result;
                        $error = 'Success';
                        $this->redirect("/admin/index");
                    }
                    else if (!empty($result) && $result["ROLE"] === 'User')
                    {
                        $_SESSION['user'] = $result;
                        $this->redirect("/home/index");
                    }
                    else {
                        $user->failure_login();
                        $error = "This login or password combination is not correct!";
                    }
                }
                else
                {
                    $error = "Account is blocked, please try to login tomorrow!";
                }
            }
            if(!empty($error)) {
                $data = ["error" => $error];
            }
        }
        $this->view('user/login', $data, 'empty_layout');
    }

    public function logoutAction()
    {
        session_start();
        if(isset($_SESSION['user']))
        {
            unset($_SESSION['user']);
        }
        $this->redirect("/home/index");
    }

    public function registerAction($data = [])
    {
        if(!empty($_POST))
        {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repeat = $_POST["repeat"];

            if(empty($username) || empty($email) || empty($password) || empty($repeat))
            {
                $error = "Don't leave any of fields empty!";
            }
            elseif(!preg_match("#.*^(?=.{8})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password))
            {
                $error =  'Your password is to weak, it should contain at least 8 characters which include at least one letter, one number, one big letter and one symbol!';
            }
            else
            {
                if(filter_var($email, FILTER_VALIDATE_EMAIL) && $password === $repeat)
                {
                    $user = new User($username, $password, $email);
                    $result = $user->create();

                    if($result)
                    {
                        $success = "You have successfully registered, you can login now!";
                    }
                    else
                    {
                        $error = "This login is already taken!";
                    }
                }
                else
                {
                    $error = "You have to repeat password properly!";
                }
            }

            if(!empty($success))
            {
                session_start();
                $_SESSION['success'] = $success;
                $this->redirect("/user/login");
            }

            else if(!empty($error))
            {
                $data = ["error" => $error];
            }
        }
        $this->view('user/register', $data, 'empty_layout');
    }
}



