<?php

namespace Src\Scoring;

use App\Entity\Users;
use Symfony\Component\Form\FormInterface;

class Scoring {
    public static function scoring(Users $user, FormInterface $form) {
        $score = 0;
        $user_data = $form->all();
            //Считаем скоринг по первым 3 цифрам номера телефона
            $megaphone_nums = array('920', '921', '922', '923', '924', '925', '926', '927', '928', '929');
            $bilain_nums = array('903','905','906','909','960','961','962','963','964','965','967');
            $mts_nums = array('910','915','916','917','911','981','918','988','989','912','917','919','982','983','914','984');

            $num_first = substr($user_data['phone']->getData(),0,1);
            if ($num_first == "+") {
                $num_pref = substr($user_data["phone"]->getData(),2,3);
                if (in_array($num_pref, $megaphone_nums)) {
                    $score += 10;
                } elseif (in_array($num_pref, $bilain_nums)) {
                    $score += 5;
                } elseif (in_array($num_pref, $mts_nums)) {
                    $score += 3;
                } else {
                    $score += 1;
                }
            } elseif($num_first == "7") {
                $num_pref = substr($user_data["phone"]->getData(),1,3);
                if (in_array($num_pref, $megaphone_nums)) {
                    $score += 10;
                } elseif (in_array($num_pref, $bilain_nums)) {
                    $score += 5;
                } elseif (in_array($num_pref, $mts_nums)) {
                    $score += 3;
                } else {
                    $score += 1;
                }
            } elseif ($num_first == "9") {
                $nums_pref = substr($user_data["phone"]->getData(),0,3);
                if (in_array($nums_pref, $megaphone_nums)) {
                    $score += 10;
                } elseif (in_array($nums_pref, $bilain_nums)) {
                    $score += 5;
                } elseif (in_array($nums_pref, $mts_nums)) {
                    $score += 3;
                } else {
                    $score += 1;
                }
            } else {
                $user_data["phone"] = 'not russian phone numbers';
                $score += 0;
            }

            //Считаем скоринг по домену почты
            $email_explode = explode("@", $user_data["email"]->getData());
            $email_user = explode(".", $email_explode[1]);
            if ($email_user[0] == "gmail") {
                $score += 10;
            } elseif ($email_user[0] == "yandex") {
                $score += 8;
            } elseif ($email_user[0] == "mail") {
                $score += 6;
            } else {
                $score += 3;
            }

            //Считаем скоринг по образованию
            $edu = $user_data["education"]->getData();
            if ($edu == "Высшее образование") {
                $score += 15;
            } elseif ($edu == "Специальное образование") {
                $score += 10;
            } else {
                $score += 5;
            }

            //Считаем скоринг по галочке
            if ($user_data["is_accept_data"]->getData() == null)  {
                $score += 0;
                $user->setFirstName($user_data['first_name']->getData());
                $user->setLastName($user_data['last_name']->getData());
                $user->setPhone($user_data['phone']->getData());
                $user->setEmail($user_data['email']->getData());
                $user->setEducation($user_data['education']->getData());
                $user->setIsAcceptData(false);
                $user->setScoring($score);
                
            } else {
                $score += 4;
                $user->setFirstName($user_data['first_name']->getData());
                $user->setLastName($user_data['last_name']->getData());
                $user->setPhone($user_data['phone']->getData());
                $user->setEmail($user_data['email']->getData());
                $user->setEducation($user_data['education']->getData());
                $user->setIsAcceptData(true);
                $user->setScoring($score);
            }

    return $user;

    }


}