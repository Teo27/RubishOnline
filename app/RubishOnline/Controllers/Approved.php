<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 21-Dec-16
 * Time: 00:42
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Model;
use RubishOnline\Models\DB_Approved;

class Approved extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function vote($id){
        $pending = new DB_Approved();
        echo $pending->upvote($id);
    }

    public function deleteQuestion($id){
        $pending = new DB_Approved();
        echo $pending->deleteQuestion($id);
    }
}