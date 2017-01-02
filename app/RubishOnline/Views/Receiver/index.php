<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/19/2016
 * Time: 11:53 AM
 */

use RubishOnline\Models\DB_Bins;

//ref http://stackoverflow.com/questions/28753600/how-to-check-if-content-txt-file-has-changed
//ref http://www.w3schools.com/php/php_file_open.asp
//ref http://stackoverflow.com/questions/6768793/get-the-full-url-in-php
//ref
//ref

$binId = $_GET["id"];
$leftR = $_GET["left"];
$rightR = $_GET["right"];
$bin = new DB_Bins();
$bin->voteLeft($binId, $leftR);
$bin->voteRight($binId, $rightR);


