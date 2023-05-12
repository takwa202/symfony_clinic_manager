<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Symptome
 *
 * @ORM\Table(name="symptome")
 * @ORM\Entity
 */
class Symptome
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_sym", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSym;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fievre", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $fievre;

    /**
     * @var int|null
     *
     * @ORM\Column(name="toux", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $toux;

    /**
     * @var int|null
     *
     * @ORM\Column(name="fatigue", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $fatigue;

    /**
     * @var int|null
     *
     * @ORM\Column(name="douleur_musculaire", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $douleurMusculaire;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mal_de_gorge", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $malDeGorge;

    /**
     * @var int|null
     *
     * @ORM\Column(name="essouflement", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $essouflement;

    /**
     * @var int|null
     *
     * @ORM\Column(name="perte_d_appetit", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $perteDAppetit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ecoulement_nasal", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $ecoulementNasal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nausee", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $nausee;

    /**
     * @var int|null
     *
     * @ORM\Column(name="vomissement", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $vomissement;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mal_de_tete", type="integer", nullable=true)
     * @Assert\NotBlank(message="Remplissez les champs")
     */
    private $malDeTete;

    /**
     * @var string|null
     *
     * @ORM\Column(name="autre", type="string", length=255, nullable=true)
     */
    private $autre;

    public function getIdSym(): ?int
    {
        return $this->idSym;
    }

    public function getFievre(): ?int
    {
        return $this->fievre;
    }

    public function setFievre(?bool $fievre): self
    {
        $this->fievre = $fievre;

        return $this;
    }

    public function getToux(): ?int
    {
        return $this->toux;
    }

    public function setToux(?int $toux): self
    {
        $this->toux = $toux;

        return $this;
    }

    public function getFatigue(): ?int
    {
        return $this->fatigue;
    }

    public function setFatigue(?int $fatigue): self
    {
        $this->fatigue = $fatigue;

        return $this;
    }

    public function getDouleurMusculaire(): ?int
    {
        return $this->douleurMusculaire;
    }

    public function setDouleurMusculaire(?int $douleurMusculaire): self
    {
        $this->douleurMusculaire = $douleurMusculaire;

        return $this;
    }

    public function getMalDeGorge(): ?int
    {
        return $this->malDeGorge;
    }

    public function setMalDeGorge(?int $malDeGorge): self
    {
        $this->malDeGorge = $malDeGorge;

        return $this;
    }

    public function getEssouflement(): ?int
    {
        return $this->essouflement;
    }

    public function setEssouflement(?int $essouflement): self
    {
        $this->essouflement = $essouflement;

        return $this;
    }

    public function getPerteDAppetit(): ?int
    {
        return $this->perteDAppetit;
    }

    public function setPerteDAppetit(?int $perteDAppetit): self
    {
        $this->perteDAppetit = $perteDAppetit;

        return $this;
    }

    public function getEcoulementNasal(): ?int
    {
        return $this->ecoulementNasal;
    }

    public function setEcoulementNasal(?int $ecoulementNasal): self
    {
        $this->ecoulementNasal = $ecoulementNasal;

        return $this;
    }

    public function getNausee(): ?int
    {
        return $this->nausee;
    }

    public function setNausee(?int $nausee): self
    {
        $this->nausee = $nausee;

        return $this;
    }

    public function getVomissement(): ?int
    {
        return $this->vomissement;
    }

    public function setVomissement(?int $vomissement): self
    {
        $this->vomissement = $vomissement;

        return $this;
    }

    public function getMalDeTete(): ?int
    {
        return $this->malDeTete;
    }

    public function setMalDeTete(?int $malDeTete): self
    {
        $this->malDeTete = $malDeTete;

        return $this;
    }

    public function getAutre(): ?string
    {
        return $this->autre;
    }

    public function setAutre(?string $autre): self
    {
        $this->autre = $autre;

        return $this;
    }


}
