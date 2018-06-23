<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserStatLogRepository")
 */
class UserStatLog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AlgorithmLog", mappedBy="userStatLog", orphanRemoval=true, cascade={"persist", "remove" })
     */
    private $data;

    public function __construct()
    {
        $this->data = new ArrayCollection();
        $this->timestamp = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return Collection|AlgorithmLog[]
     */
    public function getData(): Collection
    {
        return $this->data;
    }

    public function addData(AlgorithmLog $data): self
    {
        if (!$this->data->contains($data)) {
            $this->data[] = $data;
            $data->setUserStatLog($this);
        }

        return $this;
    }

    public function removeData(AlgorithmLog $data): self
    {
        if ($this->data->contains($data)) {
            $this->data->removeElement($data);
            // set the owning side to null (unless already changed)
            if ($data->getUserStatLog() === $this) {
                $data->setUserStatLog(null);
            }
        }

        return $this;
    }
}
