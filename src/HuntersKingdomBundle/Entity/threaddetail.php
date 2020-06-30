<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * threaddetail
 *
 * @ORM\Table(name="threaddetail")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\threaddetailRepository")
 */
class threaddetail
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
     * @ORM\Column(name="threadid", type="string", length=255)
     */
    private $threadid;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="writer", type="string", length=255)
     */
    private $writer;

    /**
     * @var string
     *
     * @ORM\Column(name="upvote", type="string", length=255)
     */
    private $upvote;

    /**
     * @var string
     *
     * @ORM\Column(name="downvote", type="string", length=255)
     */
    private $downvote;


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
     * Set threadid
     *
     * @param string $threadid
     *
     * @return threaddetail
     */
    public function setThreadid($threadid)
    {
        $this->threadid = $threadid;

        return $this;
    }

    /**
     * Get threadid
     *
     * @return string
     */
    public function getThreadid()
    {
        return $this->threadid;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return threaddetail
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set writer
     *
     * @param string $writer
     *
     * @return threaddetail
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Get writer
     *
     * @return string
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Set upvote
     *
     * @param string $upvote
     *
     * @return threaddetail
     */
    public function setUpvote($upvote)
    {
        $this->upvote = $upvote;

        return $this;
    }

    /**
     * Get upvote
     *
     * @return string
     */
    public function getUpvote()
    {
        return $this->upvote;
    }

    /**
     * Set downvote
     *
     * @param string $downvote
     *
     * @return threaddetail
     */
    public function setDownvote($downvote)
    {
        $this->downvote = $downvote;

        return $this;
    }

    /**
     * Get downvote
     *
     * @return string
     */
    public function getDownvote()
    {
        return $this->downvote;
    }
}

