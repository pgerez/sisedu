<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegimenRepository")
 */
class Regimen
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MateriaAula", mappedBy="regimen")
     */
    private $materiaAulas;

    public function __toString()
    {
        return (string) $this->getDescripcion();
    }

    public function __construct()
    {
        $this->materiaAulas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return Collection|MateriaAula[]
     */
    public function getMateriaAulas(): Collection
    {
        return $this->materiaAulas;
    }

    public function addMateriaAula(MateriaAula $materiaAula): self
    {
        if (!$this->materiaAulas->contains($materiaAula)) {
            $this->materiaAulas[] = $materiaAula;
            $materiaAula->setRegimen($this);
        }

        return $this;
    }

    public function removeMateriaAula(MateriaAula $materiaAula): self
    {
        if ($this->materiaAulas->contains($materiaAula)) {
            $this->materiaAulas->removeElement($materiaAula);
            // set the owning side to null (unless already changed)
            if ($materiaAula->getRegimen() === $this) {
                $materiaAula->setRegimen(null);
            }
        }

        return $this;
    }
}
