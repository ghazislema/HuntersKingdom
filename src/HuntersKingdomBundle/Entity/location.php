<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * location
 *
 * @ORM\Table(name="location")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\locationRepository")
 */
class location
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
     * @ORM\Column(name="adresse", type="string", length=100)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="num_portable", type="integer")
     */
    private $numPortable;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var int
     *
     * @ORM\Column(name="caution", type="integer")
     */
    private $caution;

    /**
     * @var string
     *
     * @ORM\Column(name="type_off_dem", type="string", length=50)
     */
    private $typeOffDem;

    /**
     * @var string
     *
     * @ORM\Column(name="date_debut", type="string", length=100)
     */
    private $dateDebut;

    /**
     * @var string
     *
     * @ORM\Column(name="date_fin", type="string", length=100)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=250)
     */
    private $description;


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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return location
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set numPortable
     *
     * @param integer $numPortable
     *
     * @return location
     */
    public function setNumPortable($numPortable)
    {
        $this->numPortable = $numPortable;

        return $this;
    }

    /**
     * Get numPortable
     *
     * @return int
     */
    public function getNumPortable()
    {
        return $this->numPortable;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return location
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set caution
     *
     * @param integer $caution
     *
     * @return location
     */
    public function setCaution($caution)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get caution
     *
     * @return int
     */
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * Set typeOffDem
     *
     * @param string $typeOffDem
     *
     * @return location
     */
    public function setTypeOffDem($typeOffDem)
    {
        $this->typeOffDem = $typeOffDem;

        return $this;
    }

    /**
     * Get typeOffDem
     *
     * @return string
     */
    public function getTypeOffDem()
    {
        return $this->typeOffDem;
    }

    /**
     * Set dateDebut
     *
     * @param string $dateDebut
     *
     * @return location
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return string
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param string $dateFin
     *
     * @return location
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return string
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return location
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

