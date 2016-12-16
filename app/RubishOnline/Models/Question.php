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
        $this->votes = 0;
    }

    /**
     * @return mixed
     */
    public function getApproved()
    {
        $approved = new DB_Approved();
        $retVal = $approved->getQuestions();
        if ($retVal == -2)
            echo "error in db";
        elseif ($retVal == 0)
            echo "no connection";
        /*
        else
            print_r($retVal);*/
        return $retVal;
    }

    public function insert($question, $left, $right, $user)
    {
        $count = $this->insertQuestion($question, $left, $right, $user);

        if ($count == 1) {
            /*
            Session::start();
            Session::set('loggedIn', true);

            //Redirect to some future page
            header('location: ../home');
            */
            return true;
        } else {
            return false;
        }
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


    private function insertQuestion($question, $left, $right, $user)
    {
        $retVal = 0; //no connection
        //open connection
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        $tableName = 'Pending';
        if($user == 'admin')
        {
            $tableName = 'Approved';
        }

        //if connection successful then
        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {
                //create query
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert($tableName)
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
                $retVal = $queryBuilder->execute();

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

}