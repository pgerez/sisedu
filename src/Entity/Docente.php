<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DocenteRepository")
 */
class Docente
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
     * @ORM\Column(type="integer")
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domicilio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_nacimiento;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MateriaAula", mappedBy="docente")
     */
    private $materiaAulas;

    public function __toString()
    {
        return (string) $this->getApellido().', '.$this->getNombre();
    }

    public function __construct()
    {
        $this->materiaAulas = new ArrayCollection();
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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

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

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fecha_nacimiento): self
    {
        $this->fecha_nacimiento = $fecha_nacimiento;

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
            $materiaAula->setDocente($this);
        }

        return $this;
    }

    public function removeMateriaAula(MateriaAula $materiaAula): self
    {
        if ($this->materiaAulas->contains($materiaAula)) {
            $this->materiaAulas->removeElement($materiaAula);
            // set the owning side to null (unless already changed)
            if ($materiaAula->getDocente() === $this) {
                $materiaAula->setDocente(null);
            }
        }

        return $this;
    }
}
