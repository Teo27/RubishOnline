<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 16:52
 */

namespace RubishOnline\Models;


use RubishOnline\Core\Model;
use Doctrine\DBAL\DBALException;

class Question extends Model
{
    //class for new question
    var $questionID;
    var $question;
    var $left;
    var $right;
    var $votes;


    /**
     * Question constructor.
     */
    public function __construct()
    {
        echo 'Question Model';
        $this->votes = 0;
    }

    public function insertQuestion($question, $left, $right, $user)
    {
        $retVal = 0; //no connection
        //open connection
        $connInst = new DB_Connection();
        $conn = $connInst->open();
        $tablename = 'Pending';
        if($user == 'admin')
        {
            $tablename = 'Approved';
        }

        //if connection successful then
        if (!is_null($conn) && $conn->isConnected()) {
            $conn->beginTransaction();
            try {
                //create query
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert($tablename)
                    ->values(
                        array(
                            'Question' => '?',
                            'A_Left' => '?',
                            'A_Right' => '?'
                        )
                    )
                    ->setParameter(0, $question)
                    ->setParameter(1, $left)
                    ->setParameter(2, $right);

                //execute command
                print_r($queryBuilder->execute());

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
    /**
     * @param $question
     * @param $left
     * @param $right
     */
    public function create($question, $left, $right)
    {
        $this->question = $question;
        $this->left = $left;
        $this->right = $right;
    }


    /**
     * @param mixed $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return mixed
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param mixed $left
     */
    public function setLeft($left)
    {
        $this->left = $left;
    }

    /**
     * @return mixed
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param mixed $right
     */
    public function setRight($right)
    {
        $this->right = $right;
    }

    /**
     * @return mixed
     */
    public function getVotes()
    {
        return $this->votes;
    }

    public function addVote()
    {
        $this->votes++;
    }

    /**
     * @return mixed
     */
    public function getQuestionID()
    {
        return $this->questionID;
    }


}