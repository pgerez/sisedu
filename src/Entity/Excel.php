<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExcelRepository")
 */
class Excel
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
    private $col0;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col5;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col6;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col7;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col8;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col9;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col10;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col11;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col12;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col13;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col14;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col15;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col16;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col17;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col18;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $col19;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCol0(): ?string
    {
        return $this->col0;
    }

    public function setCol0(?string $col0): self
    {
        $this->col0 = $col0;

        return $this;
    }

    public function getCol1(): ?string
    {
        return $this->col1;
    }

    public function setCol1(?string $col1): self
    {
        $this->col1 = $col1;

        return $this;
    }

    public function getCol2(): ?string
    {
        return $this->col2;
    }

    public function setCol2(?string $col2): self
    {
        $this->col2 = $col2;

        return $this;
    }

    public function getCol3(): ?string
    {
        return $this->col3;
    }

    public function setCol3(?string $col3): self
    {
        $this->col3 = $col3;

        return $this;
    }

    public function getCol4(): ?string
    {
        return $this->col4;
    }

    public function setCol4(?string $col4): self
    {
        $this->col4 = $col4;

        return $this;
    }

    public function getCol5(): ?string
    {
        return $this->col5;
    }

    public function setCol5(?string $col5): self
    {
        $this->col5 = $col5;

        return $this;
    }

    public function getCol6(): ?string
    {
        return $this->col6;
    }

    public function setCol6(?string $col6): self
    {
        $this->col6 = $col6;

        return $this;
    }

    public function getCol7(): ?string
    {
        return $this->col7;
    }

    public function setCol7(?string $col7): self
    {
        $this->col7 = $col7;

        return $this;
    }

    public function getCol8(): ?string
    {
        return $this->col8;
    }

    public function setCol8(?string $col8): self
    {
        $this->col8 = $col8;

        return $this;
    }

    public function getCol9(): ?string
    {
        return $this->col9;
    }

    public function setCol9(?string $col9): self
    {
        $this->col9 = $col9;

        return $this;
    }

    public function getCol10(): ?string
    {
        return $this->col10;
    }

    public function setCol10(?string $col10): self
    {
        $this->col10 = $col10;

        return $this;
    }

    public function getCol11(): ?string
    {
        return $this->col11;
    }

    public function setCol11(?string $col11): self
    {
        $this->col11 = $col11;

        return $this;
    }

    public function getCol12(): ?string
    {
        return $this->col12;
    }

    public function setCol12(?string $col12): self
    {
        $this->col12 = $col12;

        return $this;
    }

    public function getCol13(): ?string
    {
        return $this->col13;
    }

    public function setCol13(?string $col13): self
    {
        $this->col13 = $col13;

        return $this;
    }

    public function getCol14(): ?string
    {
        return $this->col14;
    }

    public function setCol14(?string $col14): self
    {
        $this->col14 = $col14;

        return $this;
    }

    public function getCol15(): ?string
    {
        return $this->col15;
    }

    public function setCol15(?string $col15): self
    {
        $this->col15 = $col15;

        return $this;
    }

    public function getCol16(): ?string
    {
        return $this->col16;
    }

    public function setCol16(?string $col16): self
    {
        $this->col16 = $col16;

        return $this;
    }

    public function getCol17(): ?string
    {
        return $this->col17;
    }

    public function setCol17(?string $col17): self
    {
        $this->col17 = $col17;

        return $this;
    }

    public function getCol18(): ?string
    {
        return $this->col18;
    }

    public function setCol18(?string $col18): self
    {
        $this->col18 = $col18;

        return $this;
    }

    public function getCol19(): ?string
    {
        return $this->col19;
    }

    public function setCol19(?string $col19): self
    {
        $this->col19 = $col19;

        return $this;
    }
}
