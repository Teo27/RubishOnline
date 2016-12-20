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

        $this->view->render('Bin/index');
    }

}