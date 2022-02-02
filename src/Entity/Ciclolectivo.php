<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CiclolectivoRepository")
 */
class Ciclolectivo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string" , length=255)
     */
    private $year;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_fin;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activo = 0;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aula", mappedBy="ciclolectivo")
     */
    private $aulas;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Alumno", mappedBy="ciclolectivo")
     */
    private $alumnos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanestudioCliclolectivo", mappedBy="ciclolectivo")
     */
    private $planestudioCliclolectivos;

    public function __construct()
    {
        $this->aulas = new ArrayCollection();
        $this->alumnos = new ArrayCollection();
        $this->planestudioCliclolectivos = new ArrayCollection();
    }

    public function __toString()
    {
        return  (string) $this->getYear();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(?\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->fecha_fin;
    }

    public function setFechaFin(?\DateTimeInterface $fecha_fin): self
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
            $aula->setCiclolectivo($this);
        }

        return $this;
    }

    public function removeAula(Aula $aula): self
    {
        if ($this->aulas->contains($aula)) {
            $this->aulas->removeElement($aula);
            // set the owning side to null (unless already changed)
            if ($aula->getCiclolectivo() === $this) {
                $aula->setCiclolectivo(null);
            }
        }

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return Collection|Alumno[]
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Alumno $alumno): self
    {
        if (!$this->alumnos->contains($alumno)) {
            $this->alumnos[] = $alumno;
            $alumno->setCiclolectivo($this);
        }

        return $this;
    }

    public function removeAlumno(Alumno $alumno): self
    {
        if ($this->alumnos->contains($alumno)) {
            $this->alumnos->removeElement($alumno);
            // set the owning side to null (unless already changed)
            if ($alumno->getCiclolectivo() === $this) {
                $alumno->setCiclolectivo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanestudioCliclolectivo[]
     */
    public function getPlanestudioCliclolectivos(): Collection
    {
        return $this->planestudioCliclolectivos;
    }

    public function addPlanestudioCliclolectivo(PlanestudioCliclolectivo $planestudioCliclolectivo): self
    {
        if (!$this->planestudioCliclolectivos->contains($planestudioCliclolectivo)) {
            $this->planestudioCliclolectivos[] = $planestudioCliclolectivo;
            $planestudioCliclolectivo->setCiclolectivo($this);
        }

        return $this;
    }

    public function removePlanestudioCliclolectivo(PlanestudioCliclolectivo $planestudioCliclolectivo): self
    {
        if ($this->planestudioCliclolectivos->contains($planestudioCliclolectivo)) {
            $this->planestudioCliclolectivos->removeElement($planestudioCliclolectivo);
            // set the owning side to null (unless already changed)
            if ($planestudioCliclolectivo->getCiclolectivo() === $this) {
                $planestudioCliclolectivo->setCiclolectivo(null);
            }
        }

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
}
