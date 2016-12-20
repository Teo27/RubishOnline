<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 01-Dec-16
 * Time: 15:29
 */

namespace RubishOnline\Core;


use RubishOnline\Models\DB_Connection;

class Model
{

    function __construct()
    {
        //todo
        //$$this->db = new DB_Connection(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    function value($value){
        if($value === -1){
            echo 'There was an error getting data from DB';
            return null;
        }

        if($value === 0){
            echo 'Could not connect to DB';
            return null;
        }

        return $value;
    }

    function checkId($id){

        return preg_match('/^[1-9][0-9]*$/', $id);

    }

    public function checkForSpec($string)
    {
        //check if string contains at least one character
        return preg_match('/^[a-zA-Z0-9!,.? ]*$/ ', $string);
    }
}