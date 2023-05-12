<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Intervention
 *
 * @ORM\Table(name="intervention", indexes={@ORM\Index(name="id_med", columns={"id_med"}), @ORM\Index(name="id_patien", columns={"id_patien"})})
 * @ORM\Entity(repositoryClass = "App\Repository\InterventionRepository")
 */
class Intervention
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_interv", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInterv;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptions", type="string", length=255, nullable=false)
     */
    private $descriptions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="date", nullable=false)
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date", nullable=false)
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="backgroundColor", type="string", length=255, nullable=false)
     */
    private $backgroundcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="borderColor", type="string", length=255, nullable=false)
     */
    private $bordercolor;

    /**
     * @var string
     *
     * @ORM\Column(name="textColor", type="string", length=255, nullable=false)
     */
    private $textcolor;

    /**
     * @var \Medecin
     *
     * @ORM\ManyToOne(targetEntity="Medecin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_med", referencedColumnName="id_med")
     * })
     */
    private $idMed;

    /**
     * @var \Patient
     *
     * @ORM\ManyToOne(targetEntity="Patient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_patien", referencedColumnName="Id_patient")
     * })
     */
    private $idPatien;

    public function getIdInterv(): ?int
    {
        return $this->idInterv;
    }

    public function getDescriptions(): ?string
    {
        return $this->descriptions;
    }

    public function setDescriptions(string $descriptions): self
    {
        $this->descriptions = $descriptions;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getBackgroundcolor(): ?string
    {
        return $this->backgroundcolor;
    }

    public function setBackgroundcolor(string $backgroundcolor): self
    {
        $this->backgroundcolor = $backgroundcolor;

        return $this;
    }

    public function getBordercolor(): ?string
    {
        return $this->bordercolor;
    }

    public function setBordercolor(string $bordercolor): self
    {
        $this->bordercolor = $bordercolor;

        return $this;
    }

    public function getTextcolor(): ?string
    {
        return $this->textcolor;
    }

    public function setTextcolor(string $textcolor): self
    {
        $this->textcolor = $textcolor;

        return $this;
    }

    public function getIdMed(): ?Medecin
    {
        return $this->idMed;
    }

    public function setIdMed(?Medecin $idMed): self
    {
        $this->idMed = $idMed;

        return $this;
    }

    public function getIdPatien(): ?Patient
    {
        return $this->idPatien;
    }

    public function setIdPatien(?Patient $idPatien): self
    {
        $this->idPatien = $idPatien;

        return $this;
    }


}
