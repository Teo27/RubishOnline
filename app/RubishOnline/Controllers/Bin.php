<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 14-Dec-16
 * Time: 14:29
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;
use RubishOnline\Models\DB_Bins;

class Bin extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($trashId){
        $model = new DB_Bins();
        $this->view->results = $model->getResult($trashId);

        $this->view->render('Bin/index',true);
    }

    public function createBin(){
        $bin = new DB_Bins();
        echo $bin->createBin($_POST['Address']);
    }

    public function getQuestion($trashId){
        $bin = new DB_Bins();
        echo $bin->getQuestion($trashId);
    }

    public function voteLeft($id){
        $bin = new DB_Bins();
        echo $bin->voteLeft($id);
    }

    public function voteRight($id){
        $bin = new DB_Bins();
        echo $bin->voteRight($id);
    }

    public function promote($id){
        $bin = new DB_Bins();
        echo $bin->promoteBin($id);
    }

    public function deleteBin($id){
        $bin = new DB_Bins();
        echo $bin->deleteBin($id);
    }

}