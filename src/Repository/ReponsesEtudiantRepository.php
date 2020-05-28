<?php

namespace App\Repository;

use App\Entity\ReponsesEtudiant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReponsesEtudiant|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReponsesEtudiant|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReponsesEtudiant[]    findAll()
 * @method ReponsesEtudiant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReponsesEtudiantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReponsesEtudiant::class);
    }

    // /**
    //  * @return ReponsesEtudiant[] Returns an array of ReponsesEtudiant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReponsesEtudiant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
