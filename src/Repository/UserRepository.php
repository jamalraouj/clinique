<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);

    }

    public function getDoctorDetaById(int $id)
    {
        //SELECT * FROM user WHERE fk_medecin_id = :medecin_id 
        $qb = $this->createQueryBuilder('u')
            ->select('u.nom' , 'u.prenom' , 'u.age' , 'u.address', 'u.telephone','u.email')
            ->from('App:User', 'user')
            ->where('u.fk_medecin > :medecin_id')
            ->setParameter('medecin_id', $id) ;
            
            $query = $qb->getQuery();

            return $query->execute();
    }

    public function add(User $entity, bool $flush = false): void
    {
        $entity->setJoindreA( new \DateTime());
        $entity->setDerniereConexion( new \DateTime('0000-00-00 00:00:00'));
        $entity->setMiseAJourA( new \DateTime());
        
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
