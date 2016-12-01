<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 14:53
 */

namespace RubishOnline\Models;


use RubishOnline\Core\Model;
use RubishOnline\Core\Session;

class Admin extends Model
{
    //REF http://php.net/manual/en/function.password-hash.php

    private $username;
    private $password;
    private $options = array('cost' => 12);

    public function __construct()
    {
        parent::__construct();
    }

    public function register(){

        $username = $this->cleanUser($_POST['username']);
        $pass = password_hash($this->cleanPass($_POST['password']), PASSWORD_BCRYPT, $this->options);
        echo $_POST['username'];

        //TODO Insert variables to DB

    }

    public function verify(){

        $username = $this->cleanUser($_POST['username']);
        $pass = $this->cleanPass($_POST['password']);

        //TODO select user with these parameters


        //TODO get number of rows
        $count = 0;

        if ($count >0){
            Session::start();
            Session::set('loggedIn',true);

            //Redirect to some future page
            header('location: ../home');
        }else{
            //give an error
        }
    }

    private function cleanUser($user){

        //TODO make sure the input is clean before passing

        return $user;
    }

    private function cleanPass($pass){

        //TODO make sure the input is clean before passing

        return $pass;
    }


}