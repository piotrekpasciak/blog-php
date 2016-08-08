<?php

class AdminController extends Controller
{
    public function indexAction()
    {
        if($this->authenticate())
        {
            $this->view('admin/index', [] , 'admin_layout');
        }
    }
}