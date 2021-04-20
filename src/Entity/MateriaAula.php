<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MateriaAulaRepository")
 */
class MateriaAula
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AnioMateria", inversedBy="materiaAulas")
     */
    private $aniomateria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aula", inversedBy="materiaAulas", cascade={"persist"})
     */
    private $aula;

    /**
     * @ORM\Column(type="integer")
     */
    private $nota_minima;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $asistencia;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Regimen", inversedBy="materiaAulas", cascade={"persist"})
     */
    private $regimen;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Nota", mappedBy="materiaaula")
     */
    private $notas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Docente", inversedBy="materiaAulas")
     */
    private $docente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoNota", inversedBy="materiaAulas")
     */
    private $tipo_nota;


    public function __toString()
    {
        return (string) $this->getAula().' - '.$this->getAniomateria();
    }

    public function __construct()
    {
        $this->notas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAniomateria(): ?AnioMateria
    {
        return $this->aniomateria;
    }

    public function setAniomateria(?AnioMateria $aniomateria): self
    {
        $this->aniomateria = $aniomateria;

        return $this;
    }

    public function getAula(): ?Aula
    {
        return $this->aula;
    }

    public function setAula(?Aula $aula): self
    {
        $this->aula = $aula;

        return $this;
    }

    public function getNotaMinima(): ?int
    {
        return $this->nota_minima;
    }

    public function setNotaMinima(int $nota_minima): self
    {
        $this->nota_minima = $nota_minima;

        return $this;
    }

    public function getAsistencia(): ?int
    {
        return $this->asistencia;
    }

    public function setAsistencia(int $asistencia): self
    {
        $this->asistencia = $asistencia;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getRegimen(): ?Regimen
    {
        return $this->regimen;
    }

    public function setRegimen(?Regimen $regimen): self
    {
        $this->regimen = $regimen;

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
            $nota->setMateriaaula($this);
        }

        return $this;
    }

    public function removeNota(Nota $nota): self
    {
        if ($this->notas->contains($nota)) {
            $this->notas->removeElement($nota);
            // set the owning side to null (unless already changed)
            if ($nota->getMateriaaula() === $this) {
                $nota->setMateriaaula(null);
            }
        }

        return $this;
    }

    public function getDocente(): ?Docente
    {
        return $this->docente;
    }

    public function setDocente(?Docente $docente): self
    {
        $this->docente = $docente;

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

}
