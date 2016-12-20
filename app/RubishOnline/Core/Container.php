<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 11/19/2016
 * Time: 6:14 PM
 */

namespace RubishOnline\Core;


use RubishOnline\Models\DB_Connection;
use RubishOnline\Models\Objects\ObjectBin;

class Container
{

    public static function addBinQuestion(ObjectBin $object){

        if(!isset($GLOBALS['BinQuestions'])){
            $GLOBALS['BinQuestions'] = array();
        }
        array_push($GLOBALS['BinQuestions'],$object);
        var_dump($GLOBALS['BinQuestions']);

    }

    public static function updateResult($binId, $left = null, $right = null){

        var_dump($GLOBALS['BinQuestions']);

        foreach($GLOBALS['BinQuestions'] as $arrObj){

            if($arrObj->BinId == $binId){

                if ($left != null){

                }
                if ($right != null){

                }
                var_dump($arrObj);
                break;
            }
        }



    }

    public function syncDB(){

    }

}