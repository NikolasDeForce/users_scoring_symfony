<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Users>
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    //    /**
    //     * @return Users[] Returns an array of Users objects
    //     */
       public function findByUserField(Users $user)
       {
        $users = $this->createQueryBuilder("b")->where('1 = 1');

           if ($user->getFirstName()) {
            $users->andWhere('b.first_name = :first_name')->setParameter('first_name', $user->getFirstName());
           }

           if ($user->getLastName()) {
            $users->andWhere('b.last_name = :last_name')->setParameter('user', $user->getLastName());
           }

           if ($user->getPhone()) {
            $users->andWhere('b.phone = :phone')->setParameter('phone', $user->getPhone());
            }

            if ($user->getEmail()) {
                $users->andWhere('b.email = :email')->setParameter('email', $user->getEmail());
            }

            if ($user->getEducation()) {
                $users->andWhere('b.education = :education')->setParameter('education', $user->getEducation());
            }

            if ($user->getIsAcceptData() ) {
                $users->andWhere('b.is_accept_data = :is_accept_data')->setParameter('is_accept_data', $user->getIsAcceptData());
            }

            if ($user->getScoring()) {
                $users->andWhere('b.scoring = :scoring')->setParameter('scoring', $user->getScoring());
            }
            
            return $users;
       }

    //    public function findOneBySomeField($value): ?Users
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
