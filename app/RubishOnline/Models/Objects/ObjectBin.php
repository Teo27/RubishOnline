<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 17-Dec-16
 * Time: 14:39
 */

namespace RubishOnline\Models\Objects;


class ObjectBin
{
    private $Bin_Id;
    private $Question;
    private $A_Right;
    private $A_Left;
    private $Right_Result;
    private $Left_Result;
    private $Published;
    private $Address;

    /**
     * ObjectBin constructor.
     * @param $Bin_Id
     * @param $Question
     * @param $A_Right
     * @param $A_Left
     * @param $Right_Result
     * @param $Left_Result
     * @param $Published
     * @param $Address
     */
    public function __construct($Bin_Id, $Question, $A_Right, $A_Left, $Right_Result, $Left_Result, $Published, $Address)
    {
        $this->Bin_Id = $Bin_Id;
        $this->Question = $Question;
        $this->A_Right = $A_Right;
        $this->A_Left = $A_Left;
        $this->Right_Result = $Right_Result;
        $this->Left_Result = $Left_Result;
        $this->Published = $Published;
        $this->Address = $Address;
    }

    /**
     * @param mixed $Right_Result
     */
    public function setRightResult($Right_Result)
    {
        $this->Right_Result = $Right_Result;
    }

    /**
     * @param mixed $Left_Result
     */
    public function setLeftResult($Left_Result)
    {
        $this->Left_Result = $Left_Result;
    }

    /**
     * @return mixed
     */
    public function getBinId()
    {
        return $this->Bin_Id;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->Question;
    }

    /**
     * @return mixed
     */
    public function getARight()
    {
        return $this->A_Right;
    }

    /**
     * @return mixed
     */
    public function getALeft()
    {
        return $this->A_Left;
    }

    /**
     * @return mixed
     */
    public function getRightResult()
    {
        return $this->Right_Result;
    }

    /**
     * @return mixed
     */
    public function getLeftResult()
    {
        return $this->Left_Result;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->Published;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->Address;
    }




}