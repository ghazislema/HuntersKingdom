<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * report
 *
 * @ORM\Table(name="report")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\reportRepository")
 */
class report
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
     * @ORM\Column(name="subject", type="string", length=255)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="subjectid", type="string", length=255)
     */
    private $subjectid;


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
     * Set subject
     *
     * @param string $subject
     *
     * @return report
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return report
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set subjectid
     *
     * @param string $subjectid
     *
     * @return report
     */
    public function setSubjectid($subjectid)
    {
        $this->subjectid = $subjectid;

        return $this;
    }

    /**
     * Get subjectid
     *
     * @return string
     */
    public function getSubjectid()
    {
        return $this->subjectid;
    }
}

