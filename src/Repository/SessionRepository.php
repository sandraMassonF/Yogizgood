<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function save(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Session[] Returns an array of Booking objects
    */
    public function getByDate(\DateTime $date): array
    {
         return $this->createQueryBuilder('s')
             ->andWhere('s.date > :startDate')
             ->setParameter(':startDate', $date->format('Y-m-d 00:00:00'))
             ->andWhere('s.date < :endDate')
             ->setParameter(':endDate', $date->format('Y-m-d 23:59:00'))
             ->orderBy('s.date', 'ASC')
             ->getQuery()
             ->getResult()
         ;
    }

    /**
    * @return Session[] Returns an array of Booking objects
    */
    public function getNext(): array
    {
         $date = new \DateTime('now');
         return $this->createQueryBuilder('s')
             ->select("DISTINCT DATE_FORMAT(s.date, '%Y-%m-%d') AS HIDDEN day")
             ->addSelect("s")
             ->andWhere('s.date > :startDate')
             ->setParameter(':startDate', $date->format('Y-m-d 00:00:00'))
             ->orderBy('s.date', 'ASC')
             ->groupBy('day')
             ->getQuery()
             ->getResult()
         ;
    }


//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
