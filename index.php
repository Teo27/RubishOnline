<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 15:06
 */

use RubishOnline\Tests\AdminTest;
use RubishOnline\Database\Connection;
use RubishOnline\Tests\BinTest;
use RubishOnline\Tests\QuestionTest;

require_once 'app/start.php';

//REF public files are from Bootswatch
include("app/RubishOnline/Views/Home/index.html");
$conn = new Connection();
$conn->insert();
echo "<hr>";
echo "<button type='button' onclick=''>";
//$test = new AdminTest();
//$test->checkPassFail('user','pass');

//$test = new BinTest();
//$test->createBin('name','address',15,-50);

//$test = new QuestionTest();
//$test->createQuestion('2+2',4,5);
