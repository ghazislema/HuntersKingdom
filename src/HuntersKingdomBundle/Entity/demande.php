<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Table(name="demande")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\demandeRepository")
 */
class demande
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
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadline", type="datetime")
     */
    private $deadline;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string")
     */
    private $etat;

    /**
     *
     * @ORM\ManyToOne(targetEntity="categorie")
     * @ORM\JoinColumn(name="categorie_id",referencedColumnName="id")
     */

    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="HuntersKingdomBundle\Entity\personne", inversedBy="demandes")
     * @ORM\JoinTable(name="persone_demande")
     */
    private $persones;

    public function __construct()
    {
        $this->persones = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return \DateTime
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param \DateTime $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * @param \DateTime $datePublication
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param string $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return ArrayCollection
     */
    public function getPersones()
    {
        return $this->persones;
    }

    /**
     * @param ArrayCollection $persones
     */
    public function setPersones($persones)
    {
        $this->persones = $persones;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="isValidated", type="string", length=255)
     */
    private $isValidated;

    /**
     * @return string
     */
    public function getIsValidated(): string
    {
        return $this->isValidated;
    }

    /**
     * @param string $isValidated
     */
    public function setIsValidated(string $isValidated): void
    {
        $this->isValidated = $isValidated;
    }
}

