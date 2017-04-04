<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * SubscriptionPolicy
 *
 * @ORM\Table(name="subscription_policy")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriptionPolicyRepository")
 */
class SubscriptionPolicy
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="urlPDF", type="string", length=255)
     */
    private $urlPDF;


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
     * Set name
     *
     * @param string $name
     *
     * @return SubscriptionPolicy
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return SubscriptionPolicy
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
     * Set urlPDF
     *
     * @param string $urlPDF
     *
     * @return SubscriptionPolicy
     */
    public function setUrlPDF($urlPDF)
    {
        $this->urlPDF = $urlPDF;

        return $this;
    }

    /**
     * Get urlPDF
     *
     * @return string
     */
    public function getUrlPDF()
    {
        return $this->urlPDF;
    }
}

