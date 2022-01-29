<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AulaAlumnoRepository")
 */
class AulaAlumno
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Alumno", cascade={"persist"}, inversedBy="aulaAlumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */

    private $alumno;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Aula", cascade={"persist"}, inversedBy="aulaAlumnos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aula_id", referencedColumnName="id")
     * })
     */

    private $aula;
    
    public function __toString()
    {
        return (string) $this->getAlumno();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAula(): ?Aula
    {
        return $this->aula;
    }

    public function setAula(?Aula $aula): self
    {
        $this->aula = $aula;

        return $this;
    }
}
