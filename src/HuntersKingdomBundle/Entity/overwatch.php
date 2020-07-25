<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * overwatch
 *
 * @ORM\Table(name="overwatch")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\overwatchRepository")
 */
class overwatch
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", length=500)
     */
    private $reason;

    /**
     * @var string
     *
     * @ORM\Column(name="subjectid", type="string", length=255)
     */
    private $subjectId;

    /**
     * @var string
     *
     * @ORM\Column(name="reportnb", type="string", length=255)
     */
    private $reportNb;

    /**
     * @var string
     *
     * @ORM\Column(name="userid", type="string", length=255)
     */
    private $userid;


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
     * Set type
     *
     * @param string $userid
     *
     * @return overwatch
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return overwatch
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set type
     *
     * @param string $reason
     *
     * @return overwatch
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subjectId
     *
     * @param string $subjectId
     *
     * @return overwatch
     */
    public function setSubjectId($subjectId)
    {
        $this->subjectId = $subjectId;

        return $this;
    }

    /**
     * Get subjectId
     *
     * @return string
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * Set reportNb
     *
     * @param string $reportNb
     *
     * @return overwatch
     */
    public function setReportNb($reportNb)
    {
        $this->reportNb = $reportNb;

        return $this;
    }

    /**
     * Get reportNb
     *
     * @return string
     */
    public function getReportNb()
    {
        return $this->reportNb;
    }
}

