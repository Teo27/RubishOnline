<?php

namespace RubishOnline\Tests;

use RubishOnline\Models\Question;

/**
 * Created by PhpStorm.
 * User: Teo
 * Date: 22-Nov-16
 * Time: 17:36
 */

class QuestionTest
{

    public function createQuestion($question, $left, $right){

        $qst = new Question($question, $left, $right);

        echo 'The question is ' . $qst->getQuestion();
        echo '</br> The left answer is ' . $qst->getLeft();
        echo '</br> The right answer is ' . $qst->getRight();

    }
}