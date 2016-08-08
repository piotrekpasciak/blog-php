<?php



require_once __DIR__.'/../models/Category.php';



class CategoryController extends Controller

{

    public function indexAction()

    {

        $data = [];



        if(isset($_SESSION['success'])){

            $data['success'] =  $_SESSION['success'];

            unset($_SESSION['success']);

        }



        if(isset($_SESSION['error'])){

            $data['error'] =  $_SESSION['error'];

            unset($_SESSION['error']);

        }



        if($this->authenticate()){

            $category = new Category;



            $categories = $category ->index()->fetchAll();



            $data["categories"] = $categories;



            $this->view('category/index', $data , 'admin_layout');

        }

    }



    public function newAction()

    {



        if($this->authenticate())

        {

            $data = [];



            $token = md5(uniqid(rand(), TRUE));

            $form_token = '';



            $_SESSION['token'] = $token;

            $data["token"] = $token;



            if(!empty($_POST))

            {

                $name = $_POST["name"];

                if(isset($_POST["token"])) { $form_token = $_POST["token"]; }





                /*if($form_token !== $_SESSION['token'])

                {

                    $data['error'] = "This website is attacked by CSRF!";

                }

                else 
		*/
		if(empty($name))

                {

                    $error = "Don't leave any of fields empty!";

                }

                else

                {

                    $category = new Category($name);



                    $result = $category->create();



                    if($result)

                    {

                        $success = "You have successfully created new category!";

                    }

                    else

                    {

                        $error = "This category already exist!";

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



            $this->view('category/new', $data , 'admin_layout');

        }

    }



    public function editAction($id = 0)

    {

        if($this->validate_id($id))

        {

            if($this->authenticate())

            {

                $data = [];



                if(!empty($_POST))

                {

                    $name = $_POST["name"];

                    $category = new Category($name);



                    if(empty($name))

                    {

                        $error = "Don't leave any of fields empty!";

                    }

                    else

                    {

                        $result = $category->update($id);



                        if($result)

                        {

                            $success = "You have successfully updated category!";

                        }

                        else

                        {

                            $error = "Category with this name already exists";

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



                $category = new Category();

                $result = $category->show($id)->fetch(PDO::FETCH_ASSOC);

                $data["category"] = $result;



                $this->view('/category/edit', $data , 'admin_layout');

            }

        }

    }



    public function deleteAction($id = 0)

    {

        if($this->validate_id($id))

        {

            if($this->authenticate())

            {

                if(!empty($_POST)) {



                    $category = new Category;



                    $result = $category->delete($id);



                    if ($result)

                    {

                        $_SESSION['success'] = "You have successfully deleted category!";

                    }

                    else

                    {

                        $_SESSION['error'] = "This category doesn't exist";

                    }

                }

                $this->redirect("/category/index");

            }

        }

    }

}