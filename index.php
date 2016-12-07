<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 15:06
 */

use RubishOnline\Tests\AdminTest;
use RubishOnline\Models\Admin;
use RubishOnline\Tests\BinTest;
use RubishOnline\Tests\QuestionTest;

require_once 'app/start.php';

//REF public files are from Bootswatch
//include("app/RubishOnline/Views/Home/index.html");

echo "
<!DOCTYPE html>
<html>
<body>
<form method='post'>
<input type='text' name='username'>
<br>
<input type='text' name='password'>
<br>
<button type='submit'>Gerai</button>
</form>
</body>
</html>
";
echo "Login <br>";
$conn = new Admin();
$conn->verify();
echo "<hr>";
$conn->register();
//$test = new AdminTest();
//$test->checkPassFail('user','pass');

//$test = new BinTest();
//$test->createBin('name','address',15,-50);

//$test = new QuestionTest();
//$test->createQuestion('2+2',4,5);
