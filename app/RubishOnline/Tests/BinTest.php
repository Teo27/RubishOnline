<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 17:19
 */

namespace RubishOnline\Tests;

use RubishOnline\Models\Bin;

class BinTest
{

    public function createBin($name, $address,$long = null,$lat = null){

        $bin = new Bin($name,$address,$long,$lat);

        echo 'Trash bins name is ' . $bin->getName();
        echo '</br> The address is ' . $bin->getAddress();
        if(!empty($bin->getLongitude()))
            echo '</br> The longitude is ' . $bin->getLongitude();
        if(!empty($bin->getLatitude()))
            echo '</br> The latitude is ' . $bin->getLatitude();


    }
}