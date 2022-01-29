<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlumnoRepository")
 */
class Alumno
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
     * @ORM\Column(type="string", length=255)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255)
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
     * @ORM\OneToMany(targetEntity="App\Entity\AlumnoTutor", mappedBy="alumno", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $alumnoTutors;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\NotaAlumno", mappedBy="alumno", cascade={"all"}, orphanRemoval=true)
     *
     */
    private $notaalumnos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificado", mappedBy="alumno", cascade={"all"}, orphanRemoval=true)
     */
    private $certificados;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AulaAlumno", mappedBy="alumno", cascade={"all"}, orphanRemoval=true)
     */
    private $aulaAlumnos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localidad", inversedBy="alumnos")
     */
    private $localidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciclolectivo", inversedBy="alumnos")
     */
    private $ciclolectivo;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_ingreso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $constancia_titulo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $certificado_titulo;

    /**
     * @ORM\Column(type="integer")
     */
    private $nacionalidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $legajo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lugar_nacimiento;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cuit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $materia_adeudada;



    public function __construct()
    {
        $this->alumnoTutors = new ArrayCollection();
        $this->certificados = new ArrayCollection();
        $this->aulaAlumnos = new ArrayCollection();
        $this->notaalumnos = new ArrayCollection();
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

    public function getDni(): ?string
    {
        return number_format($this->dni, null, null, ".");
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function setDomicilio(string $domicilio): self
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
            $alumnoTutor->setAlumno($this);
        }

        return $this;
    }

    public function removeAlumnoTutor(AlumnoTutor $alumnoTutor): self
    {
        if ($this->alumnoTutors->contains($alumnoTutor)) {
            $this->alumnoTutors->removeElement($alumnoTutor);
            // set the owning side to null (unless already changed)
            if ($alumnoTutor->getAlumno() === $this) {
                $alumnoTutor->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Certificado[]
     */
    public function getCertificados(): Collection
    {
        return $this->certificados;
    }

    public function addCertificado(Certificado $certificado): self
    {
        if (!$this->certificados->contains($certificado)) {
            $this->certificados[] = $certificado;
            $certificado->setAlumno($this);
        }

        return $this;
    }

    public function removeCertificado(Certificado $certificado): self
    {
        if ($this->certificados->contains($certificado)) {
            $this->certificados->removeElement($certificado);
            // set the owning side to null (unless already changed)
            if ($certificado->getAlumno() === $this) {
                $certificado->setAlumno(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AulaAlumno[]
     */
    public function getAulaAlumnos(): Collection
    {
        return $this->aulaAlumnos;
    }

    public function addAulaAlumno(AulaAlumno $aulaAlumno): self
    {
        if (!$this->aulaAlumnos->contains($aulaAlumno)) {
            $this->aulaAlumnos[] = $aulaAlumno;
            $aulaAlumno->setAlumno($this);
        }

        return $this;
    }

    public function removeAulaAlumno(AulaAlumno $aulaAlumno): self
    {
        if ($this->aulaAlumnos->contains($aulaAlumno)) {
            $this->aulaAlumnos->removeElement($aulaAlumno);
            // set the owning side to null (unless already changed)
            if ($aulaAlumno->getAlumno() === $this) {
                $aulaAlumno->setAlumno(null);
            }
        }

        return $this;
    }

    public function getLocalidad(): ?Localidad
    {
        return $this->localidad;
    }

    public function setLocalidad(?Localidad $localidad): self
    {
        $this->localidad = $localidad;

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

    public function getFechaIngreso(): ?\DateTimeInterface
    {
        return $this->fecha_ingreso;
    }

    public function setFechaIngreso(?\DateTimeInterface $fecha_ingreso): self
    {
        $this->fecha_ingreso = $fecha_ingreso;

        return $this;
    }


    public function getNacionalidad(): ?int
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(int $nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    public function getLegajo(): ?string
    {
        return $this->legajo;
    }

    public function setLegajo(?string $legajo): self
    {
        $this->legajo = $legajo;

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

    public function getConstanciaTitulo(): ?string
    {
        return $this->constancia_titulo;
    }

    public function setConstanciaTitulo(?string $constancia_titulo): self
    {
        $this->constancia_titulo = $constancia_titulo;

        return $this;
    }

    public function getCertificadoTitulo(): ?string
    {
        return $this->certificado_titulo;
    }

    public function setCertificadoTitulo(?string $certificado_titulo): self
    {
        $this->certificado_titulo = $certificado_titulo;

        return $this;
    }

    public function getLugarNacimiento(): ?string
    {
        return $this->lugar_nacimiento;
    }

    public function setLugarNacimiento(?string $lugar_nacimiento): self
    {
        $this->lugar_nacimiento = $lugar_nacimiento;

        return $this;
    }

    public function getCuit(): ?string
    {
        return $this->cuit;
    }

    public function setCuit(?string $cuit): self
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function getMateriaAdeudada(): ?string
    {
        return $this->materia_adeudada;
    }

    public function setMateriaAdeudada(?string $materia_adeudada): self
    {
        $this->materia_adeudada = $materia_adeudada;

        return $this;
    }

    /**
     * @return Collection|NotaAlumno[]
     */
    public function getNotaalumnos(): Collection
    {
        return $this->notaalumnos;
    }

    public function addNotaalumno(NotaAlumno $notaalumno): self
    {
        if (!$this->notaalumnos->contains($notaalumno)) {
            $this->notaalumnos[] = $notaalumno;
            $notaalumno->setAlumno($this);
        }

        return $this;
    }

    public function removeNotaalumno(NotaAlumno $notaalumno): self
    {
        if ($this->notaalumnos->contains($notaalumno)) {
            $this->notaalumnos->removeElement($notaalumno);
            // set the owning side to null (unless already changed)
            if ($notaalumno->getAlumno() === $this) {
                $notaalumno->setAlumno(null);
            }
        }

        return $this;
    }

    public function getCiclolectivo(): ?Ciclolectivo
    {
        return $this->ciclolectivo;
    }

    public function setCiclolectivo(?Ciclolectivo $ciclolectivo): self
    {
        $this->ciclolectivo = $ciclolectivo;

        return $this;
    }

  
}
