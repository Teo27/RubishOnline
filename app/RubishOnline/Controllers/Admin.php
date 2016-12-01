<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 20:31
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;
use RubishOnline\Models\Admin as AdminModel;

class Admin extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->view->render('admin/index');
    }

    public function index(){
        //$model = new AdminModel();
    }

    public function register(){
        $admin = $this->model('Admin');
        $admin->register();
        //echo 'user created was ', $admin->getUsername();
        //$this->view('home/index');
    }

}