<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;



/**
 * Produit
 *
 * @ORM\Table(name="produit")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass = "App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @var int
     *@Groups ("posts:read")
     * @ORM\Column(name="id_prod", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProd;

    /**
     * @var string
     *@Groups ("posts:read")
     * @ORM\Column(name="nom_prod", type="string", length=255, nullable=false)
     */
    private $nomProd;

    /**
     * @var string
     *@Groups ("posts:read")
     * @ORM\Column(name="discription", type="string", length=255, nullable=false)
     */
    private $discription;


   

    /**
     * @var int
     *@Groups ("posts:read")
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     *@Groups ("posts:read")
     * @ORM\Column(name="categories", type="string", length=255, nullable=false)
     */
    private $categories;
    
     /**
     * @var int
     *@Groups ("posts:read")
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     * @Assert\NotBlank
     */
    private $quantite;

    /**@Groups ("posts:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;



    public function getIdProd(): ?int
    {
        return $this->idProd;
    }

    public function getNomProd(): ?string
    {
        return $this->nomProd;
    }

    public function setNomProd(string $nomProd): self
    {
        $this->nomProd = $nomProd;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    
    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(string $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
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


}
