<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use App\Entity\User;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param $email
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function checkEmail($email)
    {
        return $this->createQueryBuilder('user')
            ->where('user.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $token
     *
     * @return User|null
     *
     * @throws NonUniqueResultException
     */
    public Function checkRegistrationToken($token):? User
    {
        return  $this->createQueryBuilder('user')
            ->where('user.token = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $user
     */
    public function save($user)
    {
        try {
            $this->_em->persist($user);
        } catch (ORMException $e) {
        }
        try {
            $this->_em->flush();
        } catch (OptimisticLockException $e) {
        } catch (ORMException $e) {
        }
    }

    /**
     * @param $email
     *
     * @param $token
     */
    public function saveResetToken($email, $token)
    {
        $qb = $this->createQueryBuilder('user');
        $qb->update(User::class, 'u')
            ->set('u.passwordToken', '?1')
            ->where('u.email = ?2')
            ->setParameter(1, $token)
            ->setParameter(2, $email);
        $q = $qb->getQuery();
        $q->execute();
    }

    /**
     * @param $token
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function checkResetToken($token)
    {
        return $this->createQueryBuilder('user')
            ->where('user.passwordToken = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param $token
     * @param $password
     */
    public function resetPassword($token, $password)
    {
        $qb = $this->createQueryBuilder('user');
        $qb->update(User::class, 'u')
            ->set('u.password', '?1')
            ->set('u.passwordToken', 'null')
            ->where('u.passwordToken = ?2')
            ->setParameter(1, $password)
            ->setParameter(2, $token);
        $q = $qb->getQuery();
        $q->execute();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
