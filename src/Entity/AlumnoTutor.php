<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="AlumnoTutor", indexes={@ORM\Index(name="alumno_tutor_idx", columns={"alumno_id"}), @ORM\Index(name="alumno_tutor_2idx", columns={"tutor_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\AlumnoTutorRepository")
 */
class AlumnoTutor
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Alumno", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Tutor", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tutor_id", referencedColumnName="id")
     * })
     */
    private $tutor;

    public function __toString(){
        return (string) $this->getTutor() ? $this->getTutor()->getNombre().' '.$this->getTutor()->getApellido() : 'SIN TUTOR';
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

    public function getTutor(): ?Tutor
    {
        return $this->tutor;
    }

    public function setTutor(?Tutor $tutor): self
    {
        $this->tutor = $tutor;

        return $this;
    }
    
}
