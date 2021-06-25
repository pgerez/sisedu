<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnioMateriaRepository")
 */
class AnioMateria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $correlativa;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $optativa;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $horas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $horas_catedras;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anio", inversedBy="anioMaterias")
     */
    private $anio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materia", inversedBy="anioMaterias" ,cascade={"persist"})
     */
    private $materia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MateriaAula", mappedBy="aniomateria")
     */
    private $materiaAulas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codigo;

    public function __construct()
    {
        $this->materiaAulas = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getMateria();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCorrelativa(): ?bool
    {
        return $this->correlativa;
    }

    public function setCorrelativa(?bool $correlativa): self
    {
        $this->correlativa = $correlativa;

        return $this;
    }

    public function getOptativa(): ?bool
    {
        return $this->optativa;
    }

    public function setOptativa(?bool $optativa): self
    {
        $this->optativa = $optativa;

        return $this;
    }

    public function getAnio(): ?Anio
    {
        return $this->anio;
    }

    public function setAnio(?Anio $anio): self
    {
        $this->anio = $anio;

        return $this;
    }

    public function getMateria(): ?Materia
    {
        return $this->materia;
    }

    public function setMateria(?Materia $materia): self
    {
        $this->materia = $materia;

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
            $materiaAula->setAniomateria($this);
        }

        return $this;
    }

    public function removeMateriaAula(MateriaAula $materiaAula): self
    {
        if ($this->materiaAulas->contains($materiaAula)) {
            $this->materiaAulas->removeElement($materiaAula);
            // set the owning side to null (unless already changed)
            if ($materiaAula->getAniomateria() === $this) {
                $materiaAula->setAniomateria(null);
            }
        }

        return $this;
    }

    public function getHoras(): ?int
    {
        return $this->horas;
    }

    public function setHoras(?int $horas): self
    {
        $this->horas = $horas;

        return $this;
    }

    public function getHorasCatedras(): ?int
    {
        return $this->horas_catedras;
    }

    public function setHorasCatedras(?int $horas_catedras): self
    {
        $this->horas_catedras = $horas_catedras;

        return $this;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(?int $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    
}
