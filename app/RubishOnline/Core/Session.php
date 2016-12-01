<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 01-Dec-16
 * Time: 20:01
 */

namespace RubishOnline\Core;


class Session
{

    public static function set($key,$value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        if(isset($_SESSION[$key]))
        return $_SESSION[$key];
    }

    public static function start(){
        session_start();
    }

    public static function destroy(){
        session_destroy();
    }
}