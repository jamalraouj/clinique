<?php

namespace App\Repository;

use App\Entity\Patient;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Patient>
 *
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function add(Patient $entity, bool $flush = false): void
    {
        
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Patient $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // public function add_user_info($user , $id_patient){
    //     $user->setNom($user->setNom());
    //     $user->setEmail($patient->getEmail());
    //     $user->setRoles(['ROLE_PATIENT']);
    //     $this->getEntityManager()->persist($user);
    //     $this->getEntityManager()->flush();
    // }
    public function findAllPatients()
    {
        //SELECT * FROM `patient` INNER JOIN `user` ON patient.id = user.fk_patient_id;
        return $this->createQueryBuilder('p')
            ->select('u.nom' , 'u.prenom' , 'u.age' , 'u.address', 'u.telephone' , 'u.joindre_a', 'u.mise_a_jour_a' ,'p.status_patient' , 'p.profession' ,'p.id')
            // ->from('App:User', 'u')
            ->innerJoin('App:User','u', 'WHERE' ,'p.id = u.fk_patient')
            ->getQuery()
            ->getResult();
            // echo '<pre>';
            // echo '</pre>';exit;
    } 
    public function findByExampleField($value): array
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

//    /**
//     * @return Patient[] Returns an array of Patient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Patient
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
