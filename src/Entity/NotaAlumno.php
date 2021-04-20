<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotaAlumnoRepository")
 */
class NotaAlumno
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
    private $nota;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacion;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Nota", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nota_id", referencedColumnName="id")
     * })
     */

    private $notaId;

        /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Alumno", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */

    private $alumno;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Escala", inversedBy="notaAlumnos")
     */
    private $escala;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipoNota", inversedBy="notaAlumnos")
     */
    private $tipo_nota;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $libro;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $folio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNota(): ?string
    {
        return $this->nota;
    }

    public function setNota(?string $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    public function getNotaId(): ?Nota
    {
        return $this->notaId;
    }

    public function setNotaId(?Nota $notaId): self
    {
        $this->notaId = $notaId;

        return $this;
    }

    public function getAlumno(): ?Alumno
    {
        return $this->alumno;
    }

    public function setAlumno(?Alumno $alumno): self
    {
        $this->alumno = $alumno;

        return $this;
    }

    public function getEscala(): ?Escala
    {
        return $this->escala;
    }

    public function setEscala(?Escala $escala): self
    {
        $this->escala = $escala;

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

    public function getLibro(): ?int
    {
        return $this->libro;
    }

    public function setLibro(?int $libro): self
    {
        $this->libro = $libro;

        return $this;
    }

    public function getFolio(): ?int
    {
        return $this->folio;
    }

    public function setFolio(?int $folio): self
    {
        $this->folio = $folio;

        return $this;
    }
}
