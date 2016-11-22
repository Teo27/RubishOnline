<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 15:45
 */

namespace RubishOnline\Tests;

use RubishOnline\Models\Admin;

class AdminTest
{
    public function checkPassSuccess($username,$pass){

        $test = new Admin($username,$pass);

        echo 'Username of the user is: '. $test->getUsername();
        echo '</br>Password before hash is: ' . $pass;
        echo '</br>Password after hash is: ' . $test->getPassword() . '</br>';

        $value = ($test->checkPassword($pass)) ? ('correct') : ('wrong');
        echo 'Password inputted in the code is ' . $value;

    }

    public function checkPassFail($username,$pass){

        $test = new Admin($username,$pass);

        echo 'Username of the user is: '. $test->getUsername();
        echo '</br>Password before hash is: ' . $pass;
        echo '</br>Password after hash is: ' . $test->getPassword() . '</br>';

        $value = ($test->checkPassword($test->getPassword())) ? ('correct') : ('wrong');
        echo 'Password inputted in the code is ' . $value;
    }


}