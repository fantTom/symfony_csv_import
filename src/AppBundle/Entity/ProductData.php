<?php


namespace AppBundle\Entity;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class ProductData
{
    /**
     * @Assert\NotBlank()
     * @var string
     */
    public $name;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $description;

    /**
     * @Assert\NotBlank()
     * @var string
     */
    private $code;

    /**
     * @Assert\DateTime()
     * @var \DateTimeImmutable
     */
    private $adder;

    /**
     * @Assert\DateTime()
     * @var \DateTimeImmutable
     */
    private $discontinued;

    /**
     * @Assert\NotBlank()
     * @Assert\Range( min = 10)
     * @var integer
     */
    private $stockLevel;

    /**
     * Assert\NotBlank()
     * @Assert\Range(
     *      min = 5,
     *      max = 1000
     * )
     * @var string
     */
    private $price;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
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
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return DateTime
     */
    public function getAdder()
    {
        return $this->adder;
    }

    /**
     * @param DateTime $adder
     */
    public function setAdder($adder)
    {
        $this->adder = $adder;
    }

    /**
     * @return DateTime
     */
    public function getDiscontinued()
    {
        return $this->discontinued;
    }

    /**
     * @param DateTime $discontinued
     */
    public function setDiscontinued($discontinued)
    {
        $this->discontinued = $discontinued;
    }

    /**
     * @return integer
     */
    public function getStock()
    {
        return $this->stockLevel;
    }

    /**
     * @param integer $stockLevel
     */
    public function setStock($stockLevel)
    {
        $this->stockLevel = $stockLevel;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

}