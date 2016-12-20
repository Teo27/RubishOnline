<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:30 PM
 */

namespace RubishOnline\Models;


use Doctrine\DBAL\DBALException;
use RubishOnline\Core\Model;

class DB_Results extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getQuestions()
    {
        $value = $this->getQuestionsDB();

        return $this->value($value);
    }

    private function getQuestionsDB()
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('Question, A_Left, A_Right, Left_Result, Right_Result, Published')
                    ->from('Results');

                $retVal = $queryBuilder->execute()->fetchAll();

                $conn->commit();

            } catch (DBALException $e) {
                $retVal = -2;
                $conn->rollBack();
                echo $retVal, $e->getMessage(), "\n";
            }

            $connInst->close($conn);
        } else {
            echo "no connection found";
        }
        return $retVal;
    }

}