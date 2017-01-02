<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/4/2016
 * Time: 9:30 PM
 */

namespace RubishOnline\Models;

use Doctrine\DBAL\DBALException;
use RubishOnline\Controllers\Error;
use RubishOnline\Core\Model;

class DB_Bins extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getResult($trashId)
    {
        if (!$this->checkId($trashId)) {
            return -2;
        }
        $value = $this->getResDB($trashId);

        return $this->value($value);
    }

    public function createBin($address)
    {
        if (!$this->checkForSpec($address)) {
            return -2;
        }

        $value = $this->createBinDB($address, true);

        return $this->value($value);
    }

    public function getQuestion($trashId)
    {
        if (!$this->checkId($trashId)) {
            return -2;
        }
        $value = $this->createBinDB(null,false,$trashId);

        return $this->value($value);
    }

    public function voteLeft($trashId, $leftR)
    {
        if (!$this->checkId($trashId)) {
            return -2;
        }
        if (!$this->checkId($leftR)) {
            return -2;
        }
        $value = $this->voteLeftDB($trashId, $leftR);

        return $this->value($value);
    }

    public function voteRight($trashId, $rightR)
    {
        if (!$this->checkId($trashId)) {
            return -2;
        }
        if (!$this->checkId($rightR)) {
            return -2;
        }
        $value = $this->voteRightDB($trashId, $rightR);

        return $this->value($value);
    }

    public function promoteBin($trashId)
    {
        if (!$this->checkId($trashId)) {
            return -2;
        }

        $value = $this->promoteDB($trashId);

        return $this->value($value);
    }

    public function deleteBin($id)
    {
        if (!$this->checkId($id)) {
            return -2;
        }
        $value = $this->deleteBinDB($id);

        return $this->value($value);
    }

    public function getBins()
    {
        $value = $this->getBinsDB();

        return $this->value($value);
    }

    private function getResDB($id){

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
                    ->select('Question', 'A_Right', 'A_Left', 'Right_Result', 'Left_Result')
                    ->from('Bins')
                    ->where('Bins.Bin_Id = :id')
                    ->setParameter('id',$id);

                /*
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('Question', "'Right'", "'Left'", 'Right_Result', 'Left_Result')
                    ->from('Bins')
                    ->where('Bins.bin = :id')
                    ->setParameter('id',$id);
                */

                //execute command
                $retVal = $queryBuilder->execute()->fetch();

                $conn->commit();

            } catch (DBALException $e) {

                $conn->rollBack();
                echo $e->getMessage(), "\n";
                return $retVal = -1;
            }

            //close connection
            $connInst->close($conn);

            return $retVal;

        } else {
            return $retVal;
        }


    }

    private function getCoordinates($address){

        $address = urlencode($address);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $address;
        $response = file_get_contents($url);
        $json = json_decode($response,true);

        $lat = $json['results'][0]['geometry']['location']['lat'];
        $lng = $json['results'][0]['geometry']['location']['lng'];

        return array($lat, $lng);
    }

    private function createBinDB($address, $create = false, $binId = null){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('Q_id, Question, A_Right, A_Left')
                    ->from('Approved')
                    ->orderBy('Votes','DESC')
                    ->setMaxResults(1);

                $val = $queryBuilder->execute()->fetchAll();

                if(count($val) < 1){
                    $question = 'How do you feel ?';
                    $right = 'Good';
                    $left = 'Bad';
                    $delValue = 1;
                }else{
                    $questionId = $val[0]['Q_id'];
                    $question = $val[0]['Question'];
                    $right = $val[0]['A_Right'];
                    $left = $val[0]['A_Left'];

                    $delValue = $this->removeQuestion($questionId);
                }

                if($create){
                    $insValue = $this->insertBin($question,$right,$left,$address);
                }else{
                    $insValue = $this->insertBinQuestion($question,$right,$left,$binId);
                }
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

    private function insertBinQuestion($question, $right, $left,$trashId)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {
                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->update('Bins')
                    ->set('Bins.Question', ':question')
                    ->set('Bins.A_Right', ':right')
                    ->set('Bins.A_Left', ':left')
                    ->set('Bins.Published', ':date')
                    ->set('Bins.Right_Result', ':rightRes')
                    ->set('Bins.Left_Result', ':leftRes')
                    ->where('Bins.Bin_Id = :id')
                    ->setParameter('id',$trashId)
                    ->setParameter('question', $question)
                    ->setParameter('right', $right)
                    ->setParameter('left', $left)
                    ->setParameter('rightRes', 0)
                    ->setParameter('leftRes', 0)
                    ->setParameter('date', date("Y-m-d"));

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

    private function removeQuestion($questionId){
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

    private function insertBin($question, $right, $left, $address)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $geo = $this->getCoordinates($address);

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert('Bins')
                    ->setValue('Question', '?')
                    ->setValue('A_Right', '?')
                    ->setValue('A_Left', '?')
                    ->setValue('Published', '?')
                    ->setValue('Address', '?')
                    ->setValue('Latitude', '?')
                    ->setValue('Longitude', '?')
                    ->setParameter(0, $question)
                    ->setParameter(1, $right)
                    ->setParameter(2, $left)
                    ->setParameter(3, date("Y-m-d"))
                    ->setParameter(4, $address)
                    ->setParameter(5, $geo[0])
                    ->setParameter(6, $geo[1]);

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

    private function voteLeftDB($trashId, $leftRez)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->update('Bins')
                    ->set('Bins.Left_Result', '?1')
                    ->where('Bins.Bin_Id = :id')
                    ->setParameter('id', $trashId)
                    ->setParameter(1, $leftRez);

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

    private function voteRightDB($trashId, $rightRez)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->update('Bins')
                    ->set('Bins.Right_Result', '?1')
                    ->where('Bins.Bin_Id = :id')
                    ->setParameter('id', $trashId)
                    ->setParameter(1, $rightRez);

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

    private function promoteDB($id){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('Question, A_Left, A_Right, Left_Result, Right_Result, Published')
                    ->from('Bins')
                    ->where('Bins.Bin_id = :id')
                    ->setParameter('id',$id);

                $val = $queryBuilder->execute()->fetchAll();

                $question = $val[0]['Question'];
                $right = $val[0]['A_Right'];
                $left = $val[0]['A_Left'];
                $rightRes = $val[0]['Right_Result'];
                $leftRes = $val[0]['Left_Result'];
                $published = $val[0]['Published'];

                $insValue = $this->promoteAdd($question,$right,$left,$rightRes,$leftRes,$published);
                $questionValue = $this->getQuestion($id);
                if($insValue != 1 && $questionValue != 1){
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

    private function promoteAdd($question,$right,$left,$rightRes,$leftRes,$published)
    {
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->insert('Results')
                    ->setValue('Question', '?')
                    ->setValue('A_Right', '?')
                    ->setValue('A_Left', '?')
                    ->setValue('Left_Result', '?')
                    ->setValue('Right_Result', '?')
                    ->setValue('Published', '?')
                    ->setParameter(0, $question)
                    ->setParameter(1, $right)
                    ->setParameter(2, $left)
                    ->setParameter(3, $rightRes)
                    ->setParameter(4, $leftRes)
                    ->setParameter(5, $published);

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

    private function deleteBinDB($binId){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->delete('Bins')
                    ->where('Bins.Bin_id = :id')
                    ->setParameter('id',$binId);

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

    private function getBinsDB(){
        $retVal = 0;
        $connInst = new DB_Connection();
        $conn = $connInst->open();

        if (!is_null($conn)) {
            $conn->beginTransaction();
            try {

                $queryBuilder = $conn->createQueryBuilder();
                $queryBuilder
                    ->select('*')
                    ->from('Bins');

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

}