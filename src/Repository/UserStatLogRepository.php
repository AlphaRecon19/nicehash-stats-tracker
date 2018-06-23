<?php

namespace App\Repository;

use App\Entity\UserStatLog;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserStatLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStatLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStatLog[]    findAll()
 * @method UserStatLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStatLogRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserStatLog::class);
    }

    public function getLatestLogs($mins = 15)
    {
        $date = new \DateTime("-{$mins} mins");
        $query = $this->_em->createQueryBuilder()
            ->select('usl')
            ->from('App:UserStatLog', 'usl')
            ->where('usl.timestamp >= :timestamp')
            ->setParameter('timestamp', $date)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
