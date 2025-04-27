<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $users = new Users();
            $users->setFirstName('UserFirst'. $i);
            $users->setLastName('LastName'. $i);
            $users->setPhone('+7964093112'. $i);
            $users->setEmail('user'. $i.'@gmail.com');
            $users->setEducation('Высшее образование');
            $users->setIsAcceptData('1');
            $users->setScoring(mt_rand(10,30));
            $manager->persist($users);
    
            $manager->flush();
        }

        for ($i = 0; $i < 10; $i++) {
            $users = new Users();
            $users->setFirstName('FirstUser'. $i);
            $users->setLastName('NameLast'. $i);
            $users->setPhone('+7913765453'. $i);
            $users->setEmail('name'. $i.'@mail.ru');
            $users->setEducation('Среднее образование');
            $users->setIsAcceptData('');
            $users->setScoring(mt_rand(10,30));
            $manager->persist($users);
    
            $manager->flush();
        }
    }
}
