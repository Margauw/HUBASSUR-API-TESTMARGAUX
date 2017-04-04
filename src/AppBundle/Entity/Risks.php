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
    protected $amount;

    /**
     * @ORM\ManyToMany(targetEntity="SubscriptionPolicy")
     * @ORM\JoinTable(name="risks_subscriptionpolicies",
     *      joinColumns={@ORM\JoinColumn(name="subscriptionpolicies_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subscriptionpolicies_id", referencedColumnName="id", unique=true)}
     *      )
     */
    protected $subscriptionpolicies;

    public function __construct()
    {
        $this->companies = new ArrayCollection();
        $this->subscriptionpolicies = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="Companies", inversedBy="risks")
     * @ORM\JoinTable(name="companies_risks")
     */
    protected $companies;


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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */


}