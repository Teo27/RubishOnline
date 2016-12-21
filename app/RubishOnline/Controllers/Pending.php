<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 20-Dec-16
 * Time: 23:23
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;
use RubishOnline\Models\DB_Pending;

class Pending extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function vote($id){
        $pending = new DB_Pending();
        echo $pending->upvote($id);
    }

    public function promote($id){
        $pending = new DB_Pending();
        echo $pending->promote($id);
    }

    public function deleteQuestion($id){
        $pending = new DB_Pending();
        echo $pending->deleteQuestion($id);
    }

    public function add(){
        $pending = new DB_Pending();
        echo $pending->addQuestion($_POST['Question'],$_POST['Right'],$_POST['Left']);
    }

    public function addAdmin(){
        $pending = new DB_Pending();
        echo $pending->addQuestion($_POST['Question'],$_POST['Right'],$_POST['Left'],true);
    }

}