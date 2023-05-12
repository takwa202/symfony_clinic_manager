<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FicheSuivi
 *
 * @ORM\Table(name="fiche_suivi", indexes={@ORM\Index(name="id_client", columns={"id_client"}), @ORM\Index(name="bilan_id", columns={"bilan_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\FicheSuiviRepository")
 */
class FicheSuivi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_fiche", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFiche;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diagnostic", type="string", length=255, nullable=true)
     */
    private $diagnostic;

    /**
     * @var string|null
     *
     *
     * @ORM\Column(name="consigne_medicale", type="string", length=255, nullable=true)
     *
     */
    #[Assert\NotBlank]
    private $consigneMedicale;

    /**
     * @var \Bilan
     *
     * @ORM\ManyToOne(targetEntity="Bilan")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bilan_id", referencedColumnName="id_bilan")
     * })
     */
    private $bilan;

    /**
     * @var \Patient
     *
     * @ORM\ManyToOne(targetEntity="Patient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_client", referencedColumnName="Id_patient")
     * })
     */
    private $idClient;

    public function getIdFiche(): ?int
    {
        return $this->idFiche;
    }

    public function getDiagnostic(): ?string
    {
        return $this->diagnostic;
    }

    public function setDiagnostic(?string $diagnostic): self
    {
        $this->diagnostic = $diagnostic;

        return $this;
    }

    public function getConsigneMedicale(): ?string
    {
        return $this->consigneMedicale;
    }

    public function setConsigneMedicale(?string $consigneMedicale): self
    {
        $this->consigneMedicale = $consigneMedicale;

        return $this;
    }

    public function getBilan(): ?Bilan
    {
        return $this->bilan;
    }

    public function setBilan(?Bilan $bilan): self
    {
        $this->bilan = $bilan;

        return $this;
    }

    public function getIdClient(): ?Patient
    {
        return $this->idClient;
    }

    public function setIdClient(?Patient $idClient): self
    {
        $this->idClient = $idClient;

        return $this;
    }


}
