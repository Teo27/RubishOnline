<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 12:51
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Container;
use RubishOnline\Core\Controller;
use RubishOnline\Models\DB_Approved;
use RubishOnline\Models\DB_Bins;
use RubishOnline\Models\DB_Pending;
use RubishOnline\Models\DB_Results;
use RubishOnline\Models\Objects\ObjectBin;

class Home extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view->render('home/index');
    }



    public function test($id){

        $res = new DB_Bins();
        $this->view->see = $res->deleteBin($id);
        $this->view->render('home/index');

    }

    public function test2(){


    }

}