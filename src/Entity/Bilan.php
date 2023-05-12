<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Bilan
 *
 * @ORM\Table(name="bilan")
 * @ORM\Entity(repositoryClass="App\Repository\BilanRepository")
 */
class Bilan
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_bilan", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */

    private $idBilan;
    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     *
     */
    #[Assert\NotBlank]

    private $type;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_bilan", type="datetime", nullable=true)
     */
    private $dateBilan;



    /**
     * @var string|null
     *
     * @ORM\Column(name="conclusion", type="string", length=255, nullable=true)
     */
    #[Assert\Lenght(min:4,minMessage:"trop court")]
    private $conclusion;

    public function getIdBilan(): ?int
    {
        return $this->idBilan;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateBilan(): ?\DateTimeInterface
    {
        return $this->dateBilan;
    }

    public function setDateBilan(?\DateTimeInterface $dateBilan): self
    {
        $this->dateBilan = $dateBilan;



        return $this;
    }

    public function getConclusion(): ?string
    {
        return $this->conclusion;
    }

    public function setConclusion(?string $conclusion): self
    {
        $this->conclusion = $conclusion;

        return $this;
    }

    public function getDateBilanstring()
    {
        return $this->dateBilan->format('Y-m-d H:i:s');
    }

}
