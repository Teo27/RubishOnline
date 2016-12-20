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

class DB_Admin extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register($username, $password)
    {
        if (!$this->checkForSpec($username) && !$this->checkForSpec($password)) {
            return -2;

        }

        $value = $this->insertAdmin($username, $password);

        return $this->value($value);
    }

    public function verify($username, $password)
    {
        if (!$this->checkForSpec($username) && !$this->checkForSpec($password)) {
            return -2;
        }

        $value = $this->selectAdmin($username, $password);

        return $this->value($value);
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

                $queryBuilder->execute();
                $retVal = 1;
                $conn->commit();
            } catch (DBALException $e) {
                $retVal = -1;
                $conn->rollBack();
                echo $e->getMessage(), "\n";
            }

            //close connection
            $connInst->close($conn);

            return $retVal;

        } else {
            return $retVal;
        }
    }

    private function selectAdmin($username, $password)
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
                    ->select('A_Password')
                    ->from('Admin')
                    ->where('A_Name = ?')
                    ->setParameter(0, $username);

                //execute command and set rezult
                $rez = $queryBuilder->execute()->fetchAll();

                if(count($rez) < 1){
                    return -2;
                }

                //compare passwords and give feedback
                password_verify($password, $rez[0]["A_Password"]) ? $retVal = 1 : $retVal = -1; // select successful

                $conn->commit();

            } catch (DBALException $e) {
                $retVal = -2; //select failed
                $conn->rollBack();
                echo $retVal, $e->getMessage(), "\n";
            }
            //close connection
            $connInst->close($conn);
            return $retVal;

        } else {
            return $retVal;
        }
    }

}