<?php

namespace App\Tests;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;
use Src\ScoringTest\ScoringTest;

class UsersUnitTest extends TestCase
{
    public function testScoringFunc(): void
    {
        $user = new Users();
        $user->setFirstName('UserFirst');
        $user->setLastName('LastName');
        //БИЛАЙН +5
        $user->setPhone('+7964093112');
        //GMAIL +10
        $user->setEmail('user@gmail.com');
        //Высшее образование +15
        $user->setEducation('Высшее образование');
        //Согласие на обработку = true +4
        $user->setIsAcceptData('1');

        $score = ScoringTest::scoring_test($user);

        //Общее кол-во баллов 34, сравним с функцией
        $this->assertEquals(34, $score);
    }
}
