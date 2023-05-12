<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture", indexes={@ORM\Index(name="IdProd", columns={"IdProd"}), @ORM\Index(name="idPatien", columns={"idPatien"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass = "App\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdFact", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfact;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var int
     *
     * @ORM\Column(name="Prix_Tot", type="integer", nullable=false)
     */
    private $prixTot;

    /**
     * @var int
     *
     * @ORM\Column(name="PrixAR", type="integer", nullable=false)
     */
    private $prixar;

    /**
     * @var \Produit
     *
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdProd", referencedColumnName="id_prod")
     * })
     */
    private $idprod;

    /**
     * @var \Patient
     *
     * @ORM\ManyToOne(targetEntity="Patient")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPatien", referencedColumnName="Id_patient")
     * })
     */
    private $idpatien;

    public function getIdfact(): ?int
    {
        return $this->idfact;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixTot(): ?int
    {
        return $this->prixTot;
    }

    public function setPrixTot(int $prixTot): self
    {
        $this->prixTot = $prixTot;

        return $this;
    }

    public function getPrixar(): ?int
    {
        return $this->prixar;
    }

    public function setPrixar(int $prixar): self
    {
        $this->prixar = $prixar;

        return $this;
    }

    public function getIdprod(): ?Produit
    {
        return $this->idprod;
    }

    public function setIdprod(?Produit $idprod): self
    {
        $this->idprod = $idprod;

        return $this;
    }

    public function getIdpatien(): ?Patient
    {
        return $this->idpatien;
    }

    public function setIdpatien(?Patient $idpatien): self
    {
        $this->idpatien = $idpatien;

        return $this;
    }


}
