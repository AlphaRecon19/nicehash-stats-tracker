<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlgorithmLogRepository")
 */
class AlgorithmLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Algorithm")
     * @ORM\JoinColumn(nullable=false)
     */
    private $algorithm;

    /**
     * @ORM\Column(type="float")
     */
    private $balance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStatLog", inversedBy="data")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userStatLog;

    public function getId()
    {
        return $this->id;
    }

    public function getAlgorithm(): ?Algorithm
    {
        return $this->algorithm;
    }

    public function setAlgorithm(?Algorithm $algorithm): self
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getUserStatLog(): ?UserStatLog
    {
        return $this->userStatLog;
    }

    public function setUserStatLog(?UserStatLog $userStatLog): self
    {
        $this->userStatLog = $userStatLog;

        return $this;
    }
}
