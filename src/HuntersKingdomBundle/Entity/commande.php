<?php

namespace HuntersKingdomBundle\Entity;


use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;



/**
 * commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\commandeRepository")
 */
class commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="dateAchat", type="string", length=255)
     */
    private $dateAchat;

    /**
     * @var float
     *
     * @ORM\Column(name="prixTotal", type="float")
     */
    private $prixTotal;

    /**
     * @var int
     *
     * @ORM\Column(name="quantiteTotal", type="integer")
     */
    private $quantiteTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroCommande", type="string", length=255, unique=true)
     */
    private $numeroCommande;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isValid", type="boolean")
     */
    private $isValid = false;

    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="product", cascade={"persist", "merge"})
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
    /**
     * Add products
     *
     * @param product $products
     */
    public function addProducts(product $product)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau, avec la syntaxe []
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }
    }
    /**
     * Remove products
     *
     * @param product $products
     */
    public function removeProduct(product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     * @return ArrayCollection
     *
     *
     */
    public function getProducts()
    {
        return array_values($this->products->toArray());
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateAchat
     *
     * @param string $dateAchat
     *
     * @return commande
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return string
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * Set prixTotal
     *
     * @param float $prixTotal
     *
     * @return commande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return float
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set quantiteTotal
     *
     * @param integer $quantiteTotal
     *
     * @return commande
     */
    public function setQuantiteTotal($quantiteTotal)
    {
        $this->quantiteTotal = $quantiteTotal;

        return $this;
    }

    /**
     * Get quantiteTotal
     *
     * @return int
     */
    public function getQuantiteTotal()
    {
        return $this->quantiteTotal;
    }

    /**
     * Set numeroCommande
     *
     * @param string $numeroCommande
     *
     * @return commande
     */
    public function setNumeroCommande($numeroCommande)
    {
        $this->numeroCommande = $numeroCommande;

        return $this;
    }

    /**
     * Get numeroCommande
     *
     * @return string
     */
    public function getNumeroCommande()
    {
        return $this->numeroCommande;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->isValid;
    }

    /**
     * @param bool $isValid
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }




}

