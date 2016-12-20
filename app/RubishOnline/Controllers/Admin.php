<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 20:31
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;
use RubishOnline\Core\Session;
use RubishOnline\Models\DB_Admin;

class Admin extends Controller
{
    private $options = array('cost' => 12);

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view->render('Admin/index');
    }

    public function register(){

        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $this->options);

                $admin = new DB_Admin();
                $this->view->register = $rez = $admin->register($username, $password);
            echo $rez;

        }else{
            echo 2;
            $this->view->register = -2;
        }

        //$this->view->render('Admin/index');
    }

    public function login(){

        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $admin = new DB_Admin();
            $this->view->login = $rez = $admin->verify($username, $password);

            if ($rez == 1) {
                Session::start();
                Session::set('loggedIn', true);
                header('location: ../home');
                exit;
            }

        }else{
            $this->view->login = -2;
        }

        $this->view->render('Admin/index');
    }
}