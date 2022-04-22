<?php

namespace App\Repository;

use App\Entity\Imprimante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Imprimante|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imprimante|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imprimante[]    findAll()
 * @method Imprimante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImprimanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imprimante::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Imprimante $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Imprimante $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findDisponible(): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.working = 0')
            ->getQuery()
            ->getResult();
    }

    public function getCountImprimanteDispo(): int
    {
        return $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->andWhere("i.working = 0")
            ->getQuery()
            ->getSingleScalarResult();
    }

    // /**
    //  * @return Imprimante[] Returns an array of Imprimante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Imprimante
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
