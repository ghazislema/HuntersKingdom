<?php

namespace HuntersKingdomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * thread
 *
 * @ORM\Table(name="thread")
 * @ORM\Entity(repositoryClass="HuntersKingdomBundle\Repository\threadRepository")
 */
class thread
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

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
     * @var string
     *
     * @ORM\Column(name="isValidated", type="string", length=255)
     */
    private $isValidated;

    /**
     * @var string
     *
     * @ORM\Column(name="topic", type="string", length=255)
     */
    private $topic;


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
     * Set title
     *
     * @param string $title
     *
     * @return thread
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return thread
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

    /**
     * Set upvote
     *
     * @param string $upvote
     *
     * @return thread
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
     * @return thread
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

    /**
     * Set isValidated
     *
     * @param string $isValidated
     *
     * @return thread
     */
    public function setIsValidated($isValidated)
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    /**
     * Get isValidated
     *
     * @return string
     */
    public function getIsValidated()
    {
        return $this->isValidated;
    }

    /**
     * Set topic
     *
     * @param string $topic
     *
     * @return thread
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }
}

