<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 14:53
 */

namespace RubishOnline\Models;


use RubishOnline\Core\Model;
use RubishOnline\Core\Session;
use Doctrine\DBAL\DBALException;

class Admin extends Model
{
    //REF http://php.net/manual/en/function.password-hash.php

    private $username;
    private $password;
    private $options = array('cost' => 12);

    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            if ($this->checkForSpec($_POST['username']) && $this->checkForSpec($_POST['password'])) {
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $this->options);

                $c = password_hash($_POST['password'], PASSWORD_BCRYPT, $this->options);
                print_r($c);
                echo "<br>";
                print_r(password_verify($_POST['password'], $c));
                echo "<br>";

                $count = $this->insertAdmin($username, $password);

                if ($count == 1) {
                    /*
                    Session::start();
                    Session::set('loggedIn', true);

                    //Redirect to some future page
                    header('location: ../home');*/
                    echo "registration successful";
                    return "successful";
                } else {
                    echo "error in db";
                    return "error in db";
                }
            } else {
                echo "error, bad input";
                return "error, bad input";
            }
        }
    }

    public function verify()
    {
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            if ($this->checkForSpec($_POST['username']) && $this->checkForSpec($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $count = $this->selectAdmin($username, $password);

                if ($count == 1) {
                    /*
                    Session::start();
                    Session::set('loggedIn', true);

                    //Redirect to some future page
                    header('location: ../home');
                    */
                    echo "login successful";
                    return "successful";
                } else {
                    echo "error in db";
                    return "error in db";
                }

            } else {
                echo "error, bad input";
                return "error, bad input";
            }
        }
    }

    private function checkForSpec($string)
    {
        //check if string contains at least one character
        return preg_match('/^[a-zA-Z0-9]*$/', $string);
    }

    private function insertAdmin($username, $password)
    {
        $retVal = 0; //no connection
        //open connection
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        //if connection successful then
        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {
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
                    ->setParameter(1, $password);

                //execute command
                //todo test output
                print_r($queryBuilder->execute()->fetchAll()[]);

                $retVal = 1;
                $conn->commit();
            } catch (DBALException $e) {
                $retVal = -1;
                $conn->rollBack();
                echo $e->getMessage(), "\n";
            }

            //close connection
            $connInst->close($conn);
        } else {
            echo "no connection found";
        }
        return $retVal;
    }

    private function selectAdmin($username, $password)
    {
        $retVal = 0; //no connection
        //open connection
        $connInst = new DB_Connection();
        $conn = $connInst->open();
        //&& $conn->isConnected()
        //if connection successful then
        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {
                //create query
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('A_Password')
                    ->from('Admin')
                    ->where('A_Name = ?')
                    ->setParameter(0, $username)
                ;

                //execute command and set rezult
                $rez = $queryBuilder->execute()->fetchAll();

                //compare passwords and give feedback
                password_verify($_POST["password"], $rez[0]["A_Password"])? $retVal = 1 : $retVal = -1; // select successful

                $conn->commit();

            } catch (DBALException $e) {
                $retVal = -2; //select failed
                $conn->rollBack();
                echo $retVal,$e->getMessage(), "\n";
            }
            //close connection
            $connInst->close($conn);
        } else {
            echo "no connection found";
        }
        return $retVal;
    }
}