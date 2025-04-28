<?php

namespace App\Tests;

use App\Entity\Users;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Form\FormInterface;

class UsersUnitTest extends TestCase
{
    public function testScoringFunc(): void
    {
        $user = Users::class;
        $form = FormInterface::class;

        $users_data = $form->createForm(Users::class, [

        ]);


    }
}
