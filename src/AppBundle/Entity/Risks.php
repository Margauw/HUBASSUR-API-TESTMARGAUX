<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="risks",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="name",columns={"name"})}
 * )
 */
class Risks
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $size;

    /**
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity="SubscriptionPolicy")
     * @ORM\JoinColumn(name="subscriptionpolicy_id", referencedColumnName="id")
     */
    protected $subscriptionpolicy_id;

//    public function __construct()
//    {
//        $this->companies_id = new ArrayCollection();
//        $this->subscriptionpolicies = new ArrayCollection();
//    }

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToMany(targetEntity="Companies")
     * @ORM\JoinColumn(name="companies_id", referencedColumnName="id")
     */
    protected $companies_id;


    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description= $description;
    }


    /**
     * @return mixed
     */
    public function getCompaniesId()
    {
        return $this->companies_id;
    }

    /**
     * @param mixed $companies_id
     */
    public function setCompaniesId($companies_id)
    {
        $this->companies_id = $companies_id;
    }

    /**
     * @return mixed
     */
    public function getSubscriptionpolicyId()
    {
        return $this->subscriptionpolicy_id;
    }

    /**
     * @param mixed $subscriptionpolicy_id
     */
    public function setSubscriptionpolicyId($subscriptionpolicy_id)
    {
        $this->subscriptionpolicy_id = $subscriptionpolicy_id;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }


}