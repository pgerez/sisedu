<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipocertificadoRepository")
 */
class Tipocertificado
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
    private $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Certificado", mappedBy="tipocertificado")
     */
    private $certificados;

    public function __toString()
    {
        return (string) $this->getNombre();
    }

    public function __construct()
    {
        $this->certificados = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getObservacion(): ?string
    {
        return $this->observacion;
    }

    public function setObservacion(?string $observacion): self
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * @return Collection|certificado[]
     */
    public function getCertificados(): Collection
    {
        return $this->certificados;
    }

    public function addCertificado(certificado $certificado): self
    {
        if (!$this->certificados->contains($certificado)) {
            $this->certificados[] = $certificado;
            $certificado->setTipocertificado($this);
        }

        return $this;
    }

    public function removeCertificado(certificado $certificado): self
    {
        if ($this->certificados->contains($certificado)) {
            $this->certificados->removeElement($certificado);
            // set the owning side to null (unless already changed)
            if ($certificado->getTipocertificado() === $this) {
                $certificado->setTipocertificado(null);
            }
        }

        return $this;
    }
}
