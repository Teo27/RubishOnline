<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:29 PM
 */

namespace RubishOnline\Models;

use Doctrine\DBAL\DBALException;
use RubishOnline\Core\Model;

class DB_Approved extends Model
{
    public function getQuestions()
    {
        $value = $this->getQuestionsDB();

        return $this->value($value);
    }

    public function upvote($questionId)
    {
        if (!$this->checkId($questionId)) {
            return -2;
        }
        $value = $this->upvoteDB($questionId);

        return $this->value($value);
    }

    public function deleteQuestion($id)
    {
        if (!$this->checkId($id)) {
            return -2;
        }
        $value = $this->deleteQuestionDB($id);

        return $this->value($value);
    }

    private function getQuestionsDB()
    {
        $retVal = 0; //no connection
        //open connection
        $connInst = new DB_Connection();
        $conn = $connInst->open();
        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {
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
            return $retVal;

        } else {
            return $retVal;
        }
    }

    private function upvoteDB($trashId)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->update('Approved')
                    ->set('Approved.Votes', 'Approved.Votes +1')
                    ->where('Approved.Q_id = :id')
                    ->setParameter('id',$trashId);

                $queryBuilder->execute();

                $retVal = 1;
                $conn->commit();

            } catch (DBALException $e) {

                $conn->rollBack();
                echo $e->getMessage(), "\n";
                return $retVal = -1;
            }

            $connInst->close($conn);

            return $retVal;

        } else {
            return $retVal;
        }
    }

    private function deleteQuestionDB($questionId){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->delete('Approved')
                    ->where('Approved.Q_id = :id')
                    ->setParameter('id',$questionId);

                $queryBuilder->execute();
                $retVal = 1;
                $conn->commit();

            } catch (DBALException $e) {

                $conn->rollBack();
                echo $e->getMessage(), "\n";
                return $retVal = -1;
            }

            $connInst->close($conn);

            return $retVal;

        } else {
            return $retVal;
        }
    }

}