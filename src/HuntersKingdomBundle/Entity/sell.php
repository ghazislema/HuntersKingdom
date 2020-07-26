<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *
 * @ORM\Table(name="sell")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\sellRepository")
 */
class sell
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
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="deadline", type="string")
     */
    private $deadline;

    /**
     * @var string
     *
     * @ORM\Column(name="datepublication", type="string")
     */
    private $datepublication;

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
     * @var string
     *
     * @ORM\Column(name="categorie", type="string")
     */
    private $categorie;


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
     * @return string
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param string $deadline
     */
    public function setDeadline($deadline)
    {
        $this->deadline = $deadline;
    }

    /**
     * @return string
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * @param string $datepublication
     */
    public function setDatepublication($datepublication)
    {
        $this->datePublication = $datepublication;
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
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}

