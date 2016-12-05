<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:27 PM
 */

namespace RubishOnline\Database;

use Doctrine\DBAL\DBALException;
//use Doctrine\DBAL\Query\QueryBuilder;

class Admin
{
    function insert($username, $password)
    {
        //open connection
        $connInst = new Connection();
        $conn = $connInst->open();

        //if connection successfull then
        if(!is_null($conn))
        {
            //create query
            $queryBuilder = $conn->createQueryBuilder();
            $queryBuilder
                ->insert('Admin')
                ->values(
                    array(
                        'A_Name' => '?',
                        'A_Password' => '?'
                    )
                )
                ->setParameter(0, $username)
                ->setParameter(1, $password)
            ;

            //execute command
            try{
                print_r($queryBuilder->execute());
            }
            catch(DBALException $e)
            {
                echo $e->getMessage(), "\n";
            }
            $connInst->close($conn);
        }
        else
        {
            echo "no connection found";
        }
    }
    function select($username, $password)
    {
        //open connection
        $connInst = new Connection();
        $conn = $connInst->open();

        //if connection successfull then
        if(!is_null($conn))
        {
            //create query
            $queryBuilder = $conn->createQueryBuilder();
            $queryBuilder
                ->select('A_Name', 'A_Password')
                ->from('Admin')
                ->where("A_Name = $username and A_Password = $password")
                //->setParameter(0, $username)
                //->setParameter(1, $password)
            ;

            //execute command
            try{
                print_r($queryBuilder->execute());
            }
            catch(DBALException $e)
            {
                echo $e->getMessage(), "\n";
            }
            $connInst->close($conn);
        }
        else
        {
            echo "no connection found";
        }
    }
}