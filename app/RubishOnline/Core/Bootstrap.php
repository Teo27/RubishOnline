<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 12:47
 */

namespace RubishOnline\Core;

require_once __DIR__ . '/../Config/Paths.php';

use RubishOnline\Controllers\Error;

class Bootstrap
{


    protected $controller = '';
    protected $method = 'index';
    protected $params = array();
    protected $path = '\\RubishOnline\Controllers\\';

    public function __construct()
    {
        $url = $this->parseUrl();


        if(empty($url[0])){
            $url[0] = 'Home';
        }

        //Check if controller exists - if yes continue
        if(file_exists(__DIR__ . '/../Controllers/' . $url[0] . '.php')){

            $this->controller = $url[0];

            $constr = $this->path . $this->controller;

            $this->controller = new $constr();

            unset($url[0]);

            //Check if method is written, if not use index()
            if(isset($url[1])){

                //Check if method exists
                if(method_exists($this->controller, $url[1])){

                    $this->method = $url[1];

                    unset($url[1]);

                    $this->params = $url ? array_values($url) : array();

                    call_user_func_array([$this->controller, $this->method], $this->params);

                }else{

                    new Error();
                }
            }else{

                $this->params = $url ? array_values($url) : [];

                call_user_func_array([$this->controller, $this->method], $this->params);
            }

        }else{

            new Error();
        }


    }

    protected function parseUrl(){
        if(isset($_GET['url'])){
            return $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
        }
    }
}