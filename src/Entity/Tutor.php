<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorRepository")
 */
class Tutor
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
    private $apellido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domicilio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $genero;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AlumnoTutor", mappedBy="tutor", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $alumnoTutors;



    public function __construct()
    {
        $this->alumnoTutors = new ArrayCollection();
    }

    public function __toString(){
        return (string) $this->getNombre().' '.$this->getApellido();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
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

    public function getDni(): ?int
    {
        return $this->dni;
    }

    public function setDni(int $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function setDomicilio(?string $domicilio): self
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getGenero(): ?int
    {
        return $this->genero;
    }

    public function setGenero(?int $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * @return Collection|AlumnoTutor[]
     */
    public function getAlumnoTutors(): Collection
    {
        return $this->alumnoTutors;
    }

    public function addAlumnoTutor(AlumnoTutor $alumnoTutor): self
    {
        if (!$this->alumnoTutors->contains($alumnoTutor)) {
            $this->alumnoTutors[] = $alumnoTutor;
            $alumnoTutor->setTutor($this);
        }

        return $this;
    }

    public function removeAlumnoTutor(AlumnoTutor $alumnoTutor): self
    {
        if ($this->alumnoTutors->contains($alumnoTutor)) {
            $this->alumnoTutors->removeElement($alumnoTutor);
            // set the owning side to null (unless already changed)
            if ($alumnoTutor->getTutor() === $this) {
                $alumnoTutor->setTutor(null);
            }
        }

        return $this;
    }
    
   

}
