<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeriodoRepository")
 */
class Periodo
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
    private $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nota", mappedBy="periodo")
     */
    private $notas;


    public function __toString()
    {
        return (string) $this->getNombre();
    }

    public function __construct()
    {
        $this->aulaMateriaAlumnos = new ArrayCollection();
        $this->notas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

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
     * @return Collection|Nota[]
     */
    public function getNotas(): Collection
    {
        return $this->notas;
    }

    public function addNota(Nota $nota): self
    {
        if (!$this->notas->contains($nota)) {
            $this->notas[] = $nota;
            $nota->setPeriodo($this);
        }

        return $this;
    }

    public function removeNota(Nota $nota): self
    {
        if ($this->notas->contains($nota)) {
            $this->notas->removeElement($nota);
            // set the owning side to null (unless already changed)
            if ($nota->getPeriodo() === $this) {
                $nota->setPeriodo(null);
            }
        }

        return $this;
    }



}
