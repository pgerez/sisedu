<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CertificadoRepository")
 */
class Certificado
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * 
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * 
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Alumno", cascade={"persist"}, inversedBy="certificados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="alumno_id", referencedColumnName="id")
     * })
     */
    private $alumno;

    /**
     * 
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Tipocertificado", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipocertificado_id", referencedColumnName="id")
     * })
     */
    private $tipocertificado;
    
    /**
     * 
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="App\Entity\Ciclolectivo", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ciclolectivo_id", referencedColumnName="id")
     * })
     */
    private $ciclolectivo;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_creacion;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_expiracion;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $presentado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $solicitado;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solicitado_dni;

    /**
     * @ORM\Column(type="boolean")
     */
    private $notutor;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $finalizado;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $adeuda;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $idioma;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deshabilitado;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $objeto_de;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $a_anterior;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $promedio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horario_escolar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horario_edu_fisica;

    /**
     * @ORM\Column(type="boolean")
     */
    private $del_interesado;



    public function __toString()
    {
        return (string) $this->getCodigo();
    }

    public function __construct()
    {
        $this->setPresentado('AUTORIDADES QUE LO REQUIERAN');
        $this->setDelInteresado(0);
        $this->setAAnterior(date('Y'));
    }

    /**
     * @Assert\Callback
     */
    public static function validate($object,ExecutionContextInterface $context, $payload)
    {
        if($object->getNotutor() == 0):
        
        elseif($object->getSolicitado() == ''):
            $context->buildViolation('Debe especificar el Nombre')
                    ->atPath('solicitado')
                    ->addViolation();
        elseif($object->getSolicitadoDni() == ''):
            $context->buildViolation('Debe especificar DNI')
                    ->atPath('solicitado_dni')
                    ->addViolation();
        endif;

        if(!empty($object->getEmail())):
            $validatorEmail = new EmailValidator();
            foreach(explode(",",$object->getEmail()) as $e):
                if (!$validatorEmail->isValid($e, new RFCValidation())):
                $context->buildViolation('Email "'.$e.'" Invalido')
                        ->atPath('email')
                        ->addViolation();
                endif;
            endforeach;
        endif;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

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

    public function getTipocertificado(): ?Tipocertificado
    {
        return $this->tipocertificado;
    }

    public function setTipocertificado(?Tipocertificado $tipocertificado): self
    {
        $this->tipocertificado = $tipocertificado;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fecha_creacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha_creacion): self
    {
        $this->fecha_creacion = $fecha_creacion;

        return $this;
    }

    public function getFechaExpiracion(): ?\DateTimeInterface
    {
        return $this->fecha_expiracion;
    }

    public function setFechaExpiracion(?\DateTimeInterface $fecha_expiracion): self
    {
        $this->fecha_expiracion = $fecha_expiracion;

        return $this;
    }

    public function getPresentado(): ?string
    {
        return $this->presentado;
    }

    public function setPresentado(string $presentado): self
    {
        $this->presentado = $presentado;

        return $this;
    }

    public function getSolicitado(): ?string
    {
        return $this->solicitado;
    }

    public function setSolicitado(?string $solicitado): self
    {
        $this->solicitado = $solicitado;

        return $this;
    }

    public function getSolicitadoDni(): ?int
    {
        return $this->solicitado_dni;
    }

    public function setSolicitadoDni(?int $solicitado_dni): self
    {
        $this->solicitado_dni = $solicitado_dni;

        return $this;
    }

    public function getNotutor(): ?bool
    {
        return $this->notutor;
    }

    public function setNotutor(bool $notutor): self
    {
        $this->notutor = $notutor;

        return $this;
    }

    public function getAdeuda(): ?string
    {
        return $this->adeuda;
    }

    public function setAdeuda(?string $adeuda): self
    {
        $this->adeuda = $adeuda;

        return $this;
    }

    public function getIdioma(): ?string
    {
        return $this->idioma;
    }

    public function setIdioma(?string $idioma): self
    {
        $this->idioma = $idioma;

        return $this;
    }

    public function getDeshabilitado(): ?bool
    {
        return $this->deshabilitado;
    }

    public function setDeshabilitado(bool $deshabilitado): self
    {
        $this->deshabilitado = $deshabilitado;

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

    public function getObjetoDe(): ?string
    {
        return $this->objeto_de;
    }

    public function setObjetoDe(?string $objeto_de): self
    {
        $this->objeto_de = $objeto_de;

        return $this;
    }

    public function getPromedio(): ?string
    {
        return $this->promedio;
    }

    public function setPromedio(?string $promedio): self
    {
        $this->promedio = $promedio;

        return $this;
    }

    public function getHorarioEscolar(): ?string
    {
        return $this->horario_escolar;
    }

    public function setHorarioEscolar(?string $horario_escolar): self
    {
        $this->horario_escolar = $horario_escolar;

        return $this;
    }

    public function getHorarioEduFisica(): ?string
    {
        return $this->horario_edu_fisica;
    }

    public function setHorarioEduFisica(?string $horario_edu_fisica): self
    {
        $this->horario_edu_fisica = $horario_edu_fisica;

        return $this;
    }

    public function getDelInteresado(): ?bool
    {
        return $this->del_interesado;
    }

    public function setDelInteresado(bool $del_interesado): self
    {
        $this->del_interesado = $del_interesado;

        return $this;
    }

    public function getAAnterior(): ?string
    {
        return $this->a_anterior;
    }

    public function setAAnterior(?string $a_anterior): self
    {
        $this->a_anterior = $a_anterior;

        return $this;
    }

    public function getFinalizado(): ?bool
    {
        return $this->finalizado;
    }

    public function setFinalizado(bool $finalizado): self
    {
        $this->finalizado = $finalizado;

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
