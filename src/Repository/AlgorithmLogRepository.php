<?php

namespace App\Repository;

use App\Entity\AlgorithmLog;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AlgorithmLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlgorithmLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlgorithmLog[]    findAll()
 * @method AlgorithmLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlgorithmLogRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AlgorithmLog::class);
    }
}
