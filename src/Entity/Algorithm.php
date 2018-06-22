<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlgorithmRepository")
 */
class Algorithm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nicehashId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId()
    {
        return $this->id;
    }

    public function getNicehashId(): ?int
    {
        return $this->nicehashId;
    }

    public function setNicehashId(int $nicehashId): self
    {
        $this->nicehashId = $nicehashId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
