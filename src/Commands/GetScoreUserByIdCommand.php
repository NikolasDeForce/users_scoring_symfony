<?php

namespace App\Commands;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'score:id')]
class GetScoreUserByIdCommand extends Command
{
    public function __construct(private readonly UsersRepository $usersRepository) {
        parent::__construct();
    }
    protected function configure()
    {
        $this->setDescription(
'Список правил с баллами: 
* Сотовый оператор. МегаФон - 10 баллов, Билайн - 5, МТС - 3, Иной - 1.
* Домен Э-почты. gmail - 10, yandex - 8, mail - 6, Иной - 3.
* Образование. Высшее образование - 15, Специальное образование - 10, Среднее образование - 5.
* Галочка "Я даю согласие на обработку моих личных данных". Выбрана - 4, Не выбрана - 0
')
            ->setHelp('Укажите ID пользователя после score:id')
            ->addArgument('id', InputArgument::REQUIRED, 'Укажите ID клиента, по которому желаете увидеть балл');
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user_data = $this->usersRepository->findAll();
        $scoring_output = 0;
        foreach ($user_data as $user) {
            if ($user->getId() == $input->getArgument('id')) {
                    $output->writeln(sprintf('ID: %s
    Имя: %s
    Фамилия: %s', $user->getId(), $user->getFirstName(), $user->getLastName()));
                $megaphone_nums = array('920', '921', '922', '923', '924', '925', '926', '927', '928', '929');
                $bilain_nums = array('903','905','906','909','960','961','962','963','964','965','967');
                $mts_nums = array('910','915','916','917','911','981','918','988','989','912','917','919','982','983','914','984');

                $num_first = substr($user->getPhone(),0,1);
                if ($num_first == "+") {
                    $num_pref = substr($user->getPhone(),2,3);
                    if (in_array($num_pref, $megaphone_nums)) {
                        $score = 10;
                        $scoring_output += 10;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: Мегафон
    Баллов начислено: %s
    Общее количество баллов: %s', $user->getPhone(), $score, $scoring_output));
                    } elseif (in_array($num_pref, $bilain_nums)) {
                        $score = 5;
                        $scoring_output += 5;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: БИЛАЙН
    Баллов начислено: %s
    Общее количество баллов: %s', $user->getPhone(), $score, $scoring_output));
                    } elseif (in_array($num_pref, $mts_nums)) {
                        $score = 3;
                        $scoring_output += 3;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: МТС
    Баллов начислено: %s
    Общее количество баллов: %s', $user->getPhone(), $score, $scoring_output));
                    } else {
                        $score = 1;
                        $scoring_output += 1;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: Иной оператор
    Баллов начислено: %s
    Общее количество баллов: %s', $user->getPhone(), $score, $scoring_output));
                    }
                } elseif($num_first == "7") {
                    $num_pref = substr($user->getPhone(),1,3);
                    if (in_array($num_pref, $megaphone_nums)) {
                        $score = 10;
                        $scoring_output += 10;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: Мегафон
    Баллов начислено: %s
    Общее количество баллов: %s', $user->getPhone(), $score, $scoring_output));
                    } elseif (in_array($num_pref, $bilain_nums)) {
                        $score = 5;
                        $scoring_output += 5;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: БИЛАЙН
    Баллов начислено: %s
    Общее количество баллов: %s', $user->getPhone(), $score, $scoring_output));
                    } elseif (in_array($num_pref, $mts_nums)) {
                        $score = 3;
                        $scoring_output += 3;
                        $output->writeln(sprintf('Номер телефона: %s
    Сотовый оператор: МТС
    Баллов начислено: %s
    Общее количество баллов: %s
                        ', $user->getPhone(), $score, $scoring_output));
                    } else {
                        $score = 1;
                        $scoring_output += 1;
                        $output->writeln(sprintf('Номер телефона: %s
                        Сотовый оператор: Иной оператор
                        Баллов начислено: %s
                        Общее количество баллов: %s
                        ', $user->getPhone(), $score, $scoring_output));
                    }
                } elseif ($num_first == "9") {
                    $nums_pref = substr($user->getPhone(),0,3);
                    if (in_array($nums_pref, $megaphone_nums)) {
                        $score = 10;
                        $scoring_output += 10;
                        $output->writeln(sprintf('Номер телефона: %s
                        Сотовый оператор: Мегафон
                        Баллов начислено: %s
                        Общее количество баллов: %s
                        ', $user->getPhone(), $score, $scoring_output));
                    } elseif (in_array($nums_pref, $bilain_nums)) {
                        $score = 5;
                        $scoring_output += 5;
                        $output->writeln(sprintf('Номер телефона: %s
                        Сотовый оператор: БИЛАЙН
                        Баллов начислено: %s
                        Общее количество баллов: %s
                        ', $user->getPhone(), $score, $scoring_output));
                    } elseif (in_array($nums_pref, $mts_nums)) {
                        $score = 3;
                        $scoring_output += 3;
                        $output->writeln(sprintf('Номер телефона: %s
                        Сотовый оператор: МТС
                        Баллов начислено: %s
                        Общее количество баллов: %s
                        ', $user->getPhone(), $score, $scoring_output));
                    } else {
                        $score = 1;
                        $scoring_output += 1;
                        $output->writeln(sprintf('Номер телефона: %s
                        Сотовый оператор: Иной оператор
                        Баллов начислено: %s
                        Общее количество баллов: %s
                        ', $user->getPhone(), $score, $scoring_output));
                    }
                } else {
                    $score = 0;
                    $scoring_output += 0;
                    $output->writeln(sprintf('Номер телефона: %s
                    Сотовый оператор: Не российский номер телефона
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getPhone(), $score, $scoring_output));
                }

                //Считаем скоринг по домену почты
                $email_explode = explode("@", $user->getEmail());
                $email_user = explode(".", $email_explode[1]);
                if ($email_user[0] == "gmail") {
                    $score = 10;
                    $scoring_output += 10;
                    $output->writeln(sprintf('Почта: %s
                    Домен: Gmail
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEmail(), $score, $scoring_output));
                } elseif ($email_user[0] == "yandex") {
                    $score = 8;
                    $scoring_output += 8;
                    $output->writeln(sprintf('Почта: %s
                    Домен: Yandex
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEmail(), $score, $scoring_output));
                } elseif ($email_user[0] == "mail") {
                    $score = 6;
                    $scoring_output += 6;
                    $output->writeln(sprintf('Почта: %s
                    Домен: Mail
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEmail(), $score, $scoring_output));
                } else {
                    $score = 3;
                    $scoring_output += 3;
                    $output->writeln(sprintf('Почта: %s
                    Домен: Иной
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEmail(), $score, $scoring_output));
                }

                //Считаем скоринг по образованию
                $edu = $user->getEducation();
                if ($edu == "Высшее образование") {
                    $score = 15;
                    $scoring_output += 15;
                    $output->writeln(sprintf('Образование: %s
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEducation(), $score, $scoring_output));
                } elseif ($edu == "Специальное образование") {
                    $score = 10;
                    $scoring_output += 10;
                    $output->writeln(sprintf('Образование: %s
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEducation(), $score, $scoring_output));
                } else {
                    $score = 5;
                    $scoring_output += 5;
                    $output->writeln(sprintf('Образование: %s
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getEducation(), $score, $scoring_output));
                }

                if ($user->getIsAcceptData() == null)  {
                    $score = 0;
                    $scoring_output += 0;
                    $output->writeln(sprintf('Согласие на обработку данных: %s
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getIsAcceptData(), $score, $scoring_output));
                } else {
                    $score = 4;
                    $scoring_output += 4;
                    $output->writeln(sprintf('Согласие на обработку данных: %s
                    Баллов начислено: %s
                    Общее количество баллов: %s
                    ', $user->getIsAcceptData(), $score, $scoring_output));
                }
                $output->writeln("-----------------------------------------------");
                $output->writeln(sprintf('Скоринг по клиенту ID %s равен %s', $user->getId(), $scoring_output)); 
            }
        }
        return Command::SUCCESS;
    }
}