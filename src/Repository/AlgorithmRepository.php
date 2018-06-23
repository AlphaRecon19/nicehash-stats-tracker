<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Algorithm;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Algorithm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Algorithm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Algorithm[]    findAll()
 * @method Algorithm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlgorithmRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Algorithm::class);
    }

    public function getAlgoById($id)
    {
        $find = $this->findOneBy(['nicehashId' => $id]);

        return $find;
    }
}
