<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotaRepository")
 */
class Nota
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Periodo", inversedBy="notas")
     */
    private $periodo;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotaAlumno", mappedBy="notaId", cascade={"all"}, orphanRemoval=true)
     */
    private $notaAlumnos;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MateriaAula", inversedBy="notas")
     */
    private $materiaaula;

    public function __construct()
    {
        $this->aulaMateriaAlumnos = new ArrayCollection();
        $this->notaAlumnos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriodo(): ?Periodo
    {
        return $this->periodo;
    }

    public function setPeriodo(?Periodo $periodo): self
    {
        $this->periodo = $periodo;

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
            $notaAlumno->setNotaId($this);
        }

        return $this;
    }

    public function removeNotaAlumno(NotaAlumno $notaAlumno): self
    {
        if ($this->notaAlumnos->contains($notaAlumno)) {
            $this->notaAlumnos->removeElement($notaAlumno);
            // set the owning side to null (unless already changed)
            if ($notaAlumno->getNotaId() === $this) {
                $notaAlumno->setNotaId(null);
            }
        }

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getMateriaaula(): ?MateriaAula
    {
        return $this->materiaaula;
    }

    public function setMateriaaula(?MateriaAula $materiaaula): self
    {
        $this->materiaaula = $materiaaula;

        return $this;
    }
}
