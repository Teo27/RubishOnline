<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:28 PM
 */

namespace RubishOnline\Models;


use Doctrine\DBAL\DBALException;
use RubishOnline\Core\Model;

class DB_Pending extends Model
{

    public function addQuestion($question,$right,$left, $admin = false)
    {
        if (!$this->checkForSpec($question) && !$this->checkForSpec($right) && !$this->checkForSpec($left)) {
            return -2;
        }
        $value = $this->addQuestionDB($question,$right,$left, $admin);

        return $this->value($value);
    }

    public function getQuestions()
    {
        $value = $this->getQuestionsDB();

        return $this->value($value);
    }

    public function promote($id)
    {
        if (!$this->checkId($id)) {
            return -2;
        }
        $value = $this->promoteDB($id);

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

    private function addQuestionDB($question,$right,$left,$admin)
    {
        $retVal = 0;

        $admin ? $table = 'Approved' : $table = 'Pending';

        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert($table)
                    ->setValue('Question', '?')
                    ->setValue('A_Right', '?')
                    ->setValue('A_Left', '?')
                    ->setParameter(0, $question)
                    ->setParameter(1, $right)
                    ->setParameter(2, $left);

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

    private function getQuestionsDB(){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('Q_Id, Question, A_Left, A_Right, Votes')
                    ->from('Pending')
                    ->orderBy('Votes','DESC')
                    ->setMaxResults(100);

                $retVal = $queryBuilder->execute()->fetchAll();

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

    private function promoteDB($id){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('Q_id, Question, A_Left, A_Right, Votes')
                    ->from('Pending')
                    ->where('Pending.Q_id = :id')
                    ->setParameter('id',$id);

                $val = $queryBuilder->execute()->fetchAll();

                $questionId = $val[0]['Q_id'];
                $question = $val[0]['Question'];
                $right = $val[0]['A_Right'];
                $left = $val[0]['A_Left'];

                $delValue = $this->deleteQuestionDB($questionId);
                $insValue = $this->promoteAdd($question,$right,$left);
                if($delValue != 1 || $insValue != 1){
                    return $retVal = -1;
                }
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
                    ->delete('Pending')
                    ->where('Pending.Q_id = :id')
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

    private function promoteAdd($question, $right, $left)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert('Approved')
                    ->setValue('Question', '?')
                    ->setValue('A_Right', '?')
                    ->setValue('A_Left', '?')
                    ->setParameter(0, $question)
                    ->setParameter(1, $right)
                    ->setParameter(2, $left);

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
                    ->update('Pending')
                    ->set('Pending.Votes', 'Pending.Votes +1')
                    ->where('Pending.Q_id = :id')
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

}
