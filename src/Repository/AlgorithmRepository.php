<?php

namespace App\Repository;

use App\Entity\Algorithm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Algorithm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Algorithm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Algorithm[]    findAll()
 * @method Algorithm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlgorithmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Algorithm::class);
    }
}
