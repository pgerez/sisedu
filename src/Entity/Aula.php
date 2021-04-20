<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AulaRepository")
 */
class Aula
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
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciclolectivo", inversedBy="aulas")
     */
    private $ciclolectivo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Seccion", inversedBy="aulas")
     */
    private $seccion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipoaula;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AulaAlumno", mappedBy="aula", cascade={"all"}, orphanRemoval=true)
     */
    private $aulaAlumnos;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Modalidad", inversedBy="aulas")
     */
    private $modalidad;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Anio", inversedBy="aulas")
     */
    private $anio;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MateriaAula", mappedBy="aula")
     */
    private $materiaAulas;


    public function __construct()
    {
        $this->aulaAlumnos = new ArrayCollection();
        $this->materiaAulas = new ArrayCollection();
    }

    public function __toString()
    {
        $tipo = [
            '1' => 'Grado',
            '2' => 'Año'
        ];
        $numero = [
            '1' => '1°',
            '2' => '2°',
            '3' => '3°',
            '4' => '4°',
            '5' => '5°',
            '6' => '6°',
            '7' => '7°'
        ];
        $seccion = $this->getSeccion() ? '"'.$this->getSeccion().'"' : ' ';
        return (string) $numero[$this->getNumero()].' '.$tipo[$this->getTipoaula()].' '.$seccion.' '.$this->getCiclolectivo();
    }

    public function getShowArray()
    {
        $array = [];
        foreach($this->getMateriaAulas() as $ma):
            foreach($ma->getNotas() as $nota):
                foreach($nota->getNotaAlumnos() as $na):
                    $array[$ma->getAniomateria()->getMateria()->getNombre()][$na->getAlumno()->getApellido().' '.$na->getAlumno()->getNombre()][$nota->getPeriodo()->getNombre()] = $na->getEscala();
                    #$array[$na->getAlumno()][$nota->getPeriodo()] = $na->getEscala();
                endforeach;
            endforeach;
        endforeach;
        return $array;
    }

    public function getDatosCertificado()
    {
        $tipo = [
            '1' => 'Grado',
            '2' => 'Año'
        ];
        $numero = [
            '1' => '1°',
            '2' => '2°',
            '3' => '3°',
            '4' => '4°',
            '5' => '5°',
            '6' => '6°',
            '7' => '7°'
        ];
        $seccion = $this->getSeccion() ? '"'.$this->getSeccion().'"' : ' ';
        return (string) $numero[$this->getNumero()].' '.$tipo[$this->getTipoaula()].' '.$seccion;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getSeccion(): ?Seccion
    {
        return $this->seccion;
    }

    public function setSeccion(?Seccion $seccion): self
    {
        $this->seccion = $seccion;

        return $this;
    }

    public function getTipoaula(): ?string
    {
        return $this->tipoaula;
    }

    public function setTipoaula(string $tipoaula): self
    {
        $this->tipoaula = $tipoaula;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

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
            $aulaAlumno->setAula($this);
        }

        return $this;
    }

    public function removeAulaAlumno(AulaAlumno $aulaAlumno): self
    {
        if ($this->aulaAlumnos->contains($aulaAlumno)) {
            $this->aulaAlumnos->removeElement($aulaAlumno);
            // set the owning side to null (unless already changed)
            if ($aulaAlumno->getAula() === $this) {
                $aulaAlumno->setAula(null);
            }
        }

        return $this;
    }

    public function getModalidad(): ?Modalidad
    {
        return $this->modalidad;
    }

    public function setModalidad(?Modalidad $modalidad): self
    {
        $this->modalidad = $modalidad;

        return $this;
    }



    public function getAnio(): ?Anio
    {
        return $this->anio;
    }

    public function setAnio(?Anio $anio): self
    {
        $this->anio = $anio;

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
            $materiaAula->setAula($this);
        }

        return $this;
    }

    public function removeMateriaAula(MateriaAula $materiaAula): self
    {
        if ($this->materiaAulas->contains($materiaAula)) {
            $this->materiaAulas->removeElement($materiaAula);
            // set the owning side to null (unless already changed)
            if ($materiaAula->getAula() === $this) {
                $materiaAula->setAula(null);
            }
        }

        return $this;
    }
}
