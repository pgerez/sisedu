<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EscalaRepository")
 */
class Escala
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
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoNota", inversedBy="escalas", cascade={"persist"})
     */
    private $tipo_nota;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotaAlumno", mappedBy="escala")
     */
    private $notaAlumnos;

    public function __toString()
    {
        return (string) $this->getNombre();
    }

    public function __construct()
    {
        $this->notaAlumnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTipoNota(): ?TipoNota
    {
        return $this->tipo_nota;
    }

    public function setTipoNota(?TipoNota $tipo_nota): self
    {
        $this->tipo_nota = $tipo_nota;

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
            $notaAlumno->setEscala($this);
        }

        return $this;
    }

    public function removeNotaAlumno(NotaAlumno $notaAlumno): self
    {
        if ($this->notaAlumnos->contains($notaAlumno)) {
            $this->notaAlumnos->removeElement($notaAlumno);
            // set the owning side to null (unless already changed)
            if ($notaAlumno->getEscala() === $this) {
                $notaAlumno->setEscala(null);
            }
        }

        return $this;
    }
}
