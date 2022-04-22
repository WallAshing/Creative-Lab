<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Post $entity, bool $flush = true): void
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
    public function remove(Post $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Post[] Returns an array of Post objects
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
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function sortByDate($category, $order, $maxResult): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->orderBy('p.createdAt', $order)
            ->setMaxResults($maxResult)
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    public function findAllByCategory($category, $max): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->setParameter('category', $category)
            ->setMaxResults($max)
            ->getQuery()
            ->getResult();
    }

    public function getOneByDate($category, $order): Post
    {
        return $this->createQueryBuilder('p')
            ->where('p.category = :category')
            ->orderBy('p.createdAt', $order)
            ->setMaxResults(1)
            ->setParameter('category', $category)
            ->getQuery()
            ->getSingleResult();
    }

    public function getSimilar($category, $id): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.id != :id')
            ->andWhere('p.category = :category')
            ->setParameter('id', $id)
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }
}
