<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnioRepository")
 */
class Anio
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
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Planestudio", inversedBy="anios", cascade={"persist"})
     */
    private $planestudio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AnioMateria", mappedBy="anio", cascade={"persist"})
     */
    private $anioMaterias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aula", mappedBy="anio")
     */
    private $aulas;

    public function __toString()
    {
        return (string) $this->getNumero().'° '.$this->getPlanestudio();
    }

    public function __construct()
    {
        $this->anioMaterias = new ArrayCollection();
        $this->aulas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPlanestudio(): ?Planestudio
    {
        return $this->planestudio;
    }

    public function setPlanestudio(?Planestudio $planestudio): self
    {
        $this->planestudio = $planestudio;

        return $this;
    }

    /**
     * @return Collection|AnioMateria[]
     */
    public function getAnioMaterias(): Collection
    {
        return $this->anioMaterias;
    }

    public function addAnioMateria(AnioMateria $anioMateria): self
    {
        if (!$this->anioMaterias->contains($anioMateria)) {
            $this->anioMaterias[] = $anioMateria;
            $anioMateria->setAnio($this);
        }

        return $this;
    }

    public function removeAnioMateria(AnioMateria $anioMateria): self
    {
        if ($this->anioMaterias->contains($anioMateria)) {
            $this->anioMaterias->removeElement($anioMateria);
            // set the owning side to null (unless already changed)
            if ($anioMateria->getAnio() === $this) {
                $anioMateria->setAnio(null);
            }
        }

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
            $aula->setAnio($this);
        }

        return $this;
    }

    public function removeAula(Aula $aula): self
    {
        if ($this->aulas->contains($aula)) {
            $this->aulas->removeElement($aula);
            // set the owning side to null (unless already changed)
            if ($aula->getAnio() === $this) {
                $aula->setAnio(null);
            }
        }

        return $this;
    }

   

}
