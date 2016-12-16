<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:29 PM
 */

namespace RubishOnline\Models;

use Doctrine\DBAL\DBALException;

class DB_Approved
{
    public function getQuestions()
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
                    ->select('Q_Id, Question, A_Left, A_Right, Votes')
                    ->from('Approved');

                //execute command and set rezult
                $retVal = $queryBuilder->execute()->fetchAll();

                //compare passwords and give feedback
                $conn->commit();

            } catch (DBALException $e) {
                $retVal = -2; //select failed
                $conn->rollBack();
                echo $retVal, $e->getMessage(), "\n";
            }
            //close connection
            $connInst->close($conn);
        } else {
            echo "no connection found";
        }
        return $retVal;
    }
}