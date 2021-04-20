<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanestudioRepository")
 */
class Planestudio
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
    private $nombre_plan;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre_carrera;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad_anios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Anio", mappedBy="planestudio", cascade={"persist"})
     */
    private $anios;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlanestudioCliclolectivo", mappedBy="planestudio")
     */
    private $planestudioCliclolectivos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $codigo;

    public function __toString()
    {
        return (string) $this->getNombrePlan();
    }   
    
    public function __construct()
    {
        $this->anios = new ArrayCollection();
        $this->planestudioCliclolectivos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombrePlan(): ?string
    {
        return $this->nombre_plan;
    }

    public function setNombrePlan(?string $nombre_plan): self
    {
        $this->nombre_plan = $nombre_plan;

        return $this;
    }

    public function getNombreCarrera(): ?string
    {
        return $this->nombre_carrera;
    }

    public function setNombreCarrera(?string $nombre_carrera): self
    {
        $this->nombre_carrera = $nombre_carrera;

        return $this;
    }

    public function getCantidadAnios(): ?int
    {
        return $this->cantidad_anios;
    }

    public function setCantidadAnios(int $cantidad_anios): self
    {
        $this->cantidad_anios = $cantidad_anios;

        return $this;
    }

    /**
     * @return Collection|Anio[]
     */
    public function getAnios(): Collection
    {
        return $this->anios;
    }

    public function addAnio(Anio $anio): self
    {
        if (!$this->anios->contains($anio)) {
            $this->anios[] = $anio;
            $anio->setPlanestudio($this);
        }

        return $this;
    }

    public function removeAnio(Anio $anio): self
    {
        if ($this->anios->contains($anio)) {
            $this->anios->removeElement($anio);
            // set the owning side to null (unless already changed)
            if ($anio->getPlanestudio() === $this) {
                $anio->setPlanestudio(null);
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
            $planestudioCliclolectivo->setPlanestudio($this);
        }

        return $this;
    }

    public function removePlanestudioCliclolectivo(PlanestudioCliclolectivo $planestudioCliclolectivo): self
    {
        if ($this->planestudioCliclolectivos->contains($planestudioCliclolectivo)) {
            $this->planestudioCliclolectivos->removeElement($planestudioCliclolectivo);
            // set the owning side to null (unless already changed)
            if ($planestudioCliclolectivo->getPlanestudio() === $this) {
                $planestudioCliclolectivo->setPlanestudio(null);
            }
        }

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
