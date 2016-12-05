<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 11/28/2016
 * Time: 5:22 PM
 */

namespace RubishOnline\Database;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Doctrine\DBAL\ConnectionException;
use Doctrine\DBAL\DriverManager;
use \Doctrine\DBAL\Configuration;

class Connection
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

        $config = new Configuration();
        //..
        $connectionParams = array(
            'dbname' => $database,
            'user' => $username,
            'password' => $password,
            'host' => $servername,
            'driver' => 'pdo_mysql',
        );

        //todo add try catch ConnectionException
        try
        {
            $conn = DriverManager::getConnection($connectionParams, $config);

            return $conn;
        }
        catch (ConnectionException $e)
        {
            // todo change echo later
            echo $e->getMessage(), "\n";
            return null;
        }
    }

    function close(\Doctrine\DBAL\Connection $conn)
    {
        $conn->close();
    }
}