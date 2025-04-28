<?php

namespace App\Tests;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;
use Src\ScoringTest\ScoringTest;

class UsersUnitTest extends TestCase
{
    //Проверяем домен Gmail и оператор Билайн, Высшее образование и согласие на обработку данные = true
    public function test_User_Have_Gmail_And_Bilain(): void
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

    //Проверяем домен mail, оператор Мегафон, Высшее образование, и согласие = true
    public function test_User_Have_Mail_And_Megaphone(): void
    {
        $user = new Users();
        $user->setFirstName('UserFirst');
        $user->setLastName('LastName');
        //МЕГАФОН +10
        $user->setPhone('+7920093112');
        //MAIL + 6
        $user->setEmail('user@mail.com');
        //Высшее образование +15
        $user->setEducation('Высшее образование');
        //Согласие на обработку = true +4
        $user->setIsAcceptData('1');

        $score = ScoringTest::scoring_test($user);

        //Общее кол-во баллов 25, сравним с функцией
        $this->assertEquals(35, $score);
    }

    //Проверяем домен Yandex и оператор mts, Среднее образование и согласие = false
    public function test_User_Have_Yandex_And_Mts(): void
    {
        $user = new Users();
        $user->setFirstName('UserFirst');
        $user->setLastName('LastName');
        //МТС +3 НОМЕР без + и 7 ТЕСТ
        $user->setPhone('913093112');
        //YANDEX +8
        $user->setEmail('user@gmail.com');
        //Среднее образование +5
        $user->setEducation('Среднее образование');
        //Согласие на обработку = false +0

        $score = ScoringTest::scoring_test($user);

        //Общее кол-во баллов 16, сравним с функцией
        $this->assertEquals(16, $score);
    }

    //Проверяем иной домен и иной оператор, Специальное образование и согласие = false
    public function test_User_Have_AnotherDomen_And_AnotherPhone(): void
    {
        $user = new Users();
        $user->setFirstName('UserFirst');
        $user->setLastName('LastName');
        //Иной оператор +1 НОМЕР без + и 7 ТЕСТ
        $user->setPhone('1234456781');
        //Иной домен +3
        $user->setEmail('user@cloun.com');
        //Специальное образование +10
        $user->setEducation('Специальное образование');
        //Согласие на обработку = false +0

        $score = ScoringTest::scoring_test($user);

        //Общее кол-во баллов 13, сравним с функцией
        $this->assertEquals(13, $score);
    }
}
