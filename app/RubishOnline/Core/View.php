<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 20:45
 */

namespace RubishOnline\Core;


class View
{

    function __construct()
    {
       // echo 'This is view';
    }

    public function render($name, $noRequire = false){

        if($noRequire == true){

            require __DIR__ . '/../Views/' . $name . '.php';

        }else{

            require __DIR__ . '/../Views/header.php';
            require __DIR__ . '/../Views/' . $name . '.php';
            require __DIR__ . '/../Views/footer.php';
        }

    }
}