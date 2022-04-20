<?php

namespace App\Repository;

use App\Entity\PostCateogies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PostCateogies|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostCateogies|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostCateogies[]    findAll()
 * @method PostCateogies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCateogiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostCateogies::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PostCateogies $entity, bool $flush = true): void
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
    public function remove(PostCateogies $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findWithName($name): PostCateogies
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name = :name')
            ->setMaxResults(1)
            ->setParameter('name', $name)
            ->getQuery()
            ->getSingleResult();
    }

    // /**
    //  * @return PostCateogies[] Returns an array of PostCateogies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostCateogies
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
