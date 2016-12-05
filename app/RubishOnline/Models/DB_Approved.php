<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:29 PM
 */

namespace RubishOnline\Database;


use RubishOnline\Models\Question;

class Approved
{
    function insert(Question $question)
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
                ->insert('Approved')
                ->values(
                    array(
                        'Question' => '?',
                        'A_Left' => '?',
                        'A_Right' => '?',
                        'Votes' => '?'

                    )
                )
                ->setParameter(0, $question->getQuestion())
                ->setParameter(1, $question->getLeft())
                ->setParameter(2, $question->getRight())
                ->setParameter(3, $question->getVotes())
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

    function select()
    {
        /*
        //open connection
        $connInst = new Connection();
        $conn = $connInst->open();

        //if connection successfull then
        if(!is_null($conn))
        {
            //create query
            $queryBuilder = $conn->createQueryBuilder();
            $queryBuilder
                ->insert('Approved')
                ->values(
                    array(
                        'Question' => '?',
                        'A_Left' => '?',
                        'A_Right' => '?',
                        'Votes' => '?'

                    )
                )
                ->setParameter(0, $question->getQuestion())
                ->setParameter(1, $question->getLeft())
                ->setParameter(2, $question->getRight())
                ->setParameter(3, $question->getVotes())
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
        */
    }
}