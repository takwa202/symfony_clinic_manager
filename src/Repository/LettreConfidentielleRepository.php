<?php

namespace App\Repository;

use App\Entity\LettreConfidentielle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LettreConfidentielle>
 *
 * @method LettreConfidentielle|null find($id, $lockMode = null, $lockVersion = null)
 * @method LettreConfidentielle|null findOneBy(array $criteria, array $orderBy = null)
 * @method LettreConfidentielle[]    findAll()
 * @method LettreConfidentielle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LettreConfidentielleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LettreConfidentielle::class);
    }

    public function save(LettreConfidentielle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LettreConfidentielle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LettreConfidentielle[] Returns an array of LettreConfidentielle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LettreConfidentielle
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
