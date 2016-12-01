<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 12:51
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;

class Home extends Controller
{
    private $msg;

    public function __construct()
    {
        parent::__construct();

        $this->view->render('home/index');
    }

    public function index(){

       // echo 'we are inside home </br>';

    }

    public function test($arg0 = null){

        if(empty($arg0)){
            $arg0 = 'Anonymous';
        }
        $this->msg =  'Hello, ' . $arg0;
    }

}