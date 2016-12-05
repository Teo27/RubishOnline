<?php
/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 16:52
 */

namespace RubishOnline\Models;


use RubishOnline\Core\Model;

class Question extends Model
{
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
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
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

    /**
     * @param mixed $right
     */
    public function addVote($right)
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