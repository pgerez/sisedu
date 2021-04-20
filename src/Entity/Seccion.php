<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SeccionRepository")
 */
class Seccion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $letra;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aula", mappedBy="seccion")
     */
    private $aulas;

    public function __construct()
    {
        $this->aulas = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getLetra();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLetra(): ?string
    {
        return $this->letra;
    }

    public function setLetra(?string $letra): self
    {
        $this->letra = $letra;

        return $this;
    }

    /**
     * @return Collection|Aula[]
     */
    public function getAulas(): Collection
    {
        return $this->aulas;
    }

    public function addAula(Aula $aula): self
    {
        if (!$this->aulas->contains($aula)) {
            $this->aulas[] = $aula;
            $aula->setSeccion($this);
        }

        return $this;
    }

    public function removeAula(Aula $aula): self
    {
        if ($this->aulas->contains($aula)) {
            $this->aulas->removeElement($aula);
            // set the owning side to null (unless already changed)
            if ($aula->getSeccion() === $this) {
                $aula->setSeccion(null);
            }
        }

        return $this;
    }
}
