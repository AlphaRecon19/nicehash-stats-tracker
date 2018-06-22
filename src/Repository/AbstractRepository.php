<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    public function save($entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }
}
