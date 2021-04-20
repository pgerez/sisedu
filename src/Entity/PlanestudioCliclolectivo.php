<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlanestudioCliclolectivoRepository")
 */
class PlanestudioCliclolectivo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Planestudio", inversedBy="planestudioCliclolectivos")
     */
    private $planestudio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciclolectivo", inversedBy="planestudioCliclolectivos")
     */
    private $ciclolectivo;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCiclolectivo(): ?Ciclolectivo
    {
        return $this->ciclolectivo;
    }

    public function setCiclolectivo(?Ciclolectivo $ciclolectivo): self
    {
        $this->ciclolectivo = $ciclolectivo;

        return $this;
    }
}
