<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 15:06
 */

use RubishOnline\Tests\AdminTest;
use RubishOnline\Tests\BinTest;
use RubishOnline\Tests\QuestionTest;

require_once '../app/start.php';

//REF public files are from Bootswatch

$test = new AdminTest();
$test->checkPassFail('user','pass');

//$test = new BinTest();
//$test->createBin('name','address',15,-50);

//$test = new QuestionTest();
//$test->createQuestion('2+2',4,5);
