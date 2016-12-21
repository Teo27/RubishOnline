<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 11/28/2016
 * Time: 5:22 PM
 */

namespace RubishOnline\Models;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use \Doctrine\DBAL\Configuration;

class DB_Connection
{
    function __construct()
    {

    }

    function open()
    {
        $servername = "localhost";


        $username = "keksas_user";
        $password = "mangoAdmin";
        $database = "keksas_db";
/*

        $username = "root";
        $database = "rubishonline";
*/

        $config = new Configuration();
        //..
        $connectionParams = array(
            'dbname' => $database,
            'user' => $username,
            'password' => $password,
            'host' => $servername,
            'driver' => 'pdo_mysql',
        );

        try
        {
            $conn = DriverManager::getConnection($connectionParams, $config);
            return $conn;
        }
        catch (DBALException $e)
        {
            //echo $e->getMessage(), "\n";
            return null;
        }
    }

    function close(\Doctrine\DBAL\Connection $conn)
    {
        $conn->close();
    }
}