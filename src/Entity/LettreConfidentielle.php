<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * LettreConfidentielle
 *
 * @ORM\Table(name="lettre_confidentielle", indexes={@ORM\Index(name="Id_ordonnance", columns={"Id_ordonnance"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass = "App\Repository\LettreConfidentielleRepository")
 */
class LettreConfidentielle
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdConf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idconf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    #[Assert\NotBlank]
    private $date;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank]
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=false)
     */
    #[Assert\NotBlank]
    private $signature;

    /**
     * @var \Ordonnance
     *
     * @ORM\ManyToOne(targetEntity="Ordonnance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id_ordonnance", referencedColumnName="Id_ordonnance")
     * })
     */
    #[Assert\NotBlank]
    private $idOrdonnance;

    public function getIdconf(): ?int
    {
        return $this->idconf;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;
        $this->date = new \DateTime('now');

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getIdOrdonnance(): ?Ordonnance
    {
        return $this->idOrdonnance;
    }

    public function setIdOrdonnance(?Ordonnance $idOrdonnance): self
    {
        $this->idOrdonnance = $idOrdonnance;

        return $this;
    }


}
