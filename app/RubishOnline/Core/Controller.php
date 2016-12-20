<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 30-Nov-16
 * Time: 12:48
 */

namespace RubishOnline\Core;

class Controller
{
    private $pathModel = '\\RubishOnline\Models\\';

    private $pathView = '\\RubishOnline\Views\\';

    public function __construct()
    {
        $this->view = new View();
    }

    protected function model($model)
    {

        $constr = $this->pathModel . $model;

        return new $constr();
    }


}