<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 20:11
 */

namespace RubishOnline\Controllers;


use RubishOnline\Core\Controller;

class Error extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->view->msg = 'This page does not exist';
        $this->view->render('Error/index', true);
    }

    public function index(){

    }
}