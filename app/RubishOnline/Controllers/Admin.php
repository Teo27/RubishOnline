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
use RubishOnline\Models\DB_Approved;
use RubishOnline\Models\DB_Bins;
use RubishOnline\Models\DB_Pending;
use RubishOnline\Models\DB_Results;

class Admin extends Controller
{
    private $options = array('cost' => 12);

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view->render('Admin/index', true);
    }

    public function register(){

        if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $this->options);

                $admin = new DB_Admin();
                $this->view->register = $rez = $admin->register($username, $password);
            echo $rez;

        }else{
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
                header('location: ../admin/home');
                exit;
            }

        }else{
            $this->view->login = -2;
        }

        $this->view->render('Admin/index', true);
    }

    public function home(){
        $this->initAll();
        $this->view->render('Admin/home', true);
    }

    private function initAll(){
        $pending = new DB_Pending();
        $approved = new DB_Approved();
        $bins = new DB_Bins();
        $results = new DB_Results();

        $this->view->pending = $pending->getQuestions();
        $this->view->approved = $approved->getQuestions();
        $this->view->bins = $bins->getBins();
        $this->view->results = $results->getQuestions();

    }

    public function createBin($id, $question, $left, $right, $rezL, $rezR)
    {
        $file = fopen("../Config/BinsFiles/$id.txt", "w") or die("Unable to open file!");
        $txt = $question . "\n";
        fwrite($file, $txt);

        $txt = $left . "\n";
        fwrite($file, $txt);

        $txt = $right . "\n";
        fwrite($file, $txt);

        $txt = $rezL . "\n";
        fwrite($file, $txt);

        $txt = $rezR . "\n";
        fwrite($file, $txt);

        fclose($file);
    }
}