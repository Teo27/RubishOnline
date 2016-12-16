<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 20:31
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;
use RubishOnline\Models\ModelAdmin;
use RubishOnline\Models\Question;

class Admin extends Controller
{
    private $options = array('cost' => 12);

    public function __construct()
    {
        parent::__construct();
        //todo throw error
        //$this->view->render('admin/index');
    }

    public function index(){
        //$model = new AdminModel();
    }

    public function register(){
        //echo 'user created was ', $admin->getUsername();
        //$this->view('home/index');

        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            if ($this->checkForSpec($_POST['username']) && $this->checkForSpec($_POST['password'])) {
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $this->options);

                $admin = new ModelAdmin();
                $rez = $admin->register($username, $password);
                if ($rez == true) {
                    echo "registration successful";
                    //refresh page - Admin created
                } else {
                    echo "error";
                    //refresh page - wrong credentials
                }
            } else {
                return "error, bad input";
            }
        }
        return false;
    }

    public function login()
    {
        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
            if ($this->checkForSpec($_POST['username']) && $this->checkForSpec($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $admin = $this->model('ModelAdmin');
                $rez = $admin->verify($username, $password);
                if ($rez) {
                    echo "login successful";
                    //open Admin panel
                } else {
                    echo "error";
                    //refresh page - wrong credentials
                }
            } else {
                return "error, bad input";
            }
        }
        return false;
    }

    public function addQuestion()
    {
        if (isset($_POST['question']) && isset($_POST['left']) && isset($_POST['right'])) {
            if ($this->checkForSpec($_POST['question']) && $this->checkForSpec($_POST['left']) && $this->checkForSpec($_POST['right'])) {
                $question = $_POST['question'];
                $left = $_POST['left'];
                $right = $_POST['right'];
                $qInst = new Question();
                $rez = $qInst->insert($question, $left, $right, 'admin');
                if ($rez) {
                    echo "insert successful";
                    //refresh page - successful
                } else {
                    echo "error";
                    //refresh page - something is wrong
                }
            } else {
                echo "error, bad input";
                return "error, bad input";
            }
        }
        return false;
    }
}