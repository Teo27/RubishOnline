<?php
/**
 * Created by PhpStorm.
 * User: Goofy
 * Date: 12/13/2016
 * Time: 10:35 PM
 */

namespace RubishOnline\Tests;

use PHPUnit\Framework\TestCase;
use RubishOnline\Models\DB_Approved;

class AdminModelTest extends TestCase
{
    public function testGetApproved()
    {
        $approved = new DB_Approved();
        $list = $approved->getQuestions();
        $this->assertArrayHasKey('Q_Id', $list);
        $this->assertArrayHasKey('Question', $list);
        $this->assertArrayHasKey('A_Left', $list);
        $this->assertArrayHasKey('A_Right', $list);
        $this->assertArrayHasKey('Votes', $list);
    }
}
