<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MateriaRepository")
 */
class Materia
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
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_fin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AnioMateria", mappedBy="materia")
     */
    private $anioMaterias;

    public function __construct()
    {
        $this->anioMaterias = new ArrayCollection();
    }



    public function __toString(){
        return (string) $this->getNombre();
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
            $anioMateria->setMateria($this);
        }

        return $this;
    }

    public function removeAnioMateria(AnioMateria $anioMateria): self
    {
        if ($this->anioMaterias->contains($anioMateria)) {
            $this->anioMaterias->removeElement($anioMateria);
            // set the owning side to null (unless already changed)
            if ($anioMateria->getMateria() === $this) {
                $anioMateria->setMateria(null);
            }
        }

        return $this;
    }


}
