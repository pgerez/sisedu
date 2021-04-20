<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipoNotaRepository")
 */
class TipoNota
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
     * @ORM\OneToMany(targetEntity="App\Entity\Escala", mappedBy="tipo_nota", cascade={"persist"})
     */
    private $escalas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MateriaAula", mappedBy="tipo_nota")
     */
    private $materiaAulas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotaAlumno", mappedBy="tipo_nota")
     */
    private $notaAlumnos;

    public function __toString()
    {
        return (string) $this->getDescripcion();
    }

    public function __construct()
    {
        $this->escalas = new ArrayCollection();
        $this->materiaAulas = new ArrayCollection();
        $this->notaAlumnos = new ArrayCollection();
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
     * @return Collection|Escala[]
     */
    public function getEscalas(): Collection
    {
        return $this->escalas;
    }

    public function addEscala(Escala $escala): self
    {
        if (!$this->escalas->contains($escala)) {
            $this->escalas[] = $escala;
            $escala->setTipoNota($this);
        }

        return $this;
    }

    public function removeEscala(Escala $escala): self
    {
        if ($this->escalas->contains($escala)) {
            $this->escalas->removeElement($escala);
            // set the owning side to null (unless already changed)
            if ($escala->getTipoNota() === $this) {
                $escala->setTipoNota(null);
            }
        }

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
            $materiaAula->setTipoNota($this);
        }

        return $this;
    }

    public function removeMateriaAula(MateriaAula $materiaAula): self
    {
        if ($this->materiaAulas->contains($materiaAula)) {
            $this->materiaAulas->removeElement($materiaAula);
            // set the owning side to null (unless already changed)
            if ($materiaAula->getTipoNota() === $this) {
                $materiaAula->setTipoNota(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NotaAlumno[]
     */
    public function getNotaAlumnos(): Collection
    {
        return $this->notaAlumnos;
    }

    public function addNotaAlumno(NotaAlumno $notaAlumno): self
    {
        if (!$this->notaAlumnos->contains($notaAlumno)) {
            $this->notaAlumnos[] = $notaAlumno;
            $notaAlumno->setTipoNota($this);
        }

        return $this;
    }

    public function removeNotaAlumno(NotaAlumno $notaAlumno): self
    {
        if ($this->notaAlumnos->contains($notaAlumno)) {
            $this->notaAlumnos->removeElement($notaAlumno);
            // set the owning side to null (unless already changed)
            if ($notaAlumno->getTipoNota() === $this) {
                $notaAlumno->setTipoNota(null);
            }
        }

        return $this;
    }
}
