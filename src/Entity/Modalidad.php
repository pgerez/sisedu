<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ModalidadRepository")
 */
class Modalidad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aula", mappedBy="modalidad")
     */
    private $aulas;

    public function __toString()
    {
        return (string) $this->getNombre();
    }

    public function __construct()
    {
        $this->aulas = new ArrayCollection();
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
            $aula->setModalidad($this);
        }

        return $this;
    }

    public function removeAula(Aula $aula): self
    {
        if ($this->aulas->contains($aula)) {
            $this->aulas->removeElement($aula);
            // set the owning side to null (unless already changed)
            if ($aula->getModalidad() === $this) {
                $aula->setModalidad(null);
            }
        }

        return $this;
    }

}
