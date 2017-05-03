<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="companies",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="companies_unique",columns={"id"})}
 * )
 */
class Companies
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
    protected $address;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @ORM\Column(type="string")
     */
    protected $postcode;

    /**
     * @ORM\Column(type="string")
     */
    protected $website;

    /**
     * @ORM\Column(type="integer")
     */
    protected $telephone;

    /**
     * @ORM\Column(type="integer")
     */
    protected $fax;

    /**
     * @ORM\Column(type="string")
     */
    protected $video;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToMany(targetEntity="Risks")
     * @ORM\JoinColumn(name="risks_id", referencedColumnName="id")
     */
    protected $risks_id;

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="TypeCompanie")
     * @ORM\JoinColumn(name="typecompanie_id", referencedColumnName="id")
     */
    protected $typecompanie_id;


//    public function __construct() {
//        $this->risks_id = new ArrayCollection();
//    }


    /**
     * @return mixed
     */
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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address= $address;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param mixed $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getRisksId()
    {
        return $this->risks_id;
    }

    /**
     * @param mixed $risks_id
     */
    public function setRisksId($risks_id)
    {
        $this->risks_id = $risks_id;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getTypecompanieId()
    {
        return $this->typecompanie_id;
    }

    /**
     * @param mixed $typecompanie_id
     */
    public function setTypecompanieId($typecompanie_id)
    {
        $this->typecompanie_id = $typecompanie_id;
    }


}