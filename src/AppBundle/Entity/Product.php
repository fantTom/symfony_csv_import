<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="tblProductData", uniqueConstraints={@ORM\UniqueConstraint(name="productCode", columns={"strProductCode"})})
 * @ORM\Entity
 */
class Product
{

    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="intProductDataId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $productId;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductName", type="string", length=50)
     */
    private $productName;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductDesc", type="string", length=255)
     */
    private $productDesc;

    /**
     * @var string
     *
     * @ORM\Column(name="strProductCode", type="string", length=10, unique=true)
     */
    private $productCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmAdded", type="datetime", nullable=true)
     */
    private $adder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dtmDiscontinued", type="datetime", nullable=true)
     */
    private $discontinued;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="stmTimestamp", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $timestamp;

    /**
     * @var integer
     *
     * @ORM\Column(name="stock_level", type="integer")
     */
    private $stockLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * Product constructor.
     * @param $productName
     * @param $productCode
     * @param $productDesc
     * @param $stockLevel
     * @param $price
     * @param null $adder
     * @param null $discontinued
     */
    public function __construct($productName, $productCode, $productDesc, $stockLevel, $price, \DateTime $adder = null, $discontinued = null)
    {
        $this->productName = $productName;
        $this->productCode = $productCode;
        $this->productDesc = $productDesc;
        $this->stockLevel = $stockLevel;
        $this->price = $price;
        $this->adder = $adder;
        $this->discontinued = $discontinued;
        $this->timestamp = new \DateTime();
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    /**
     * @param string $productDesc
     */
    public function setProductDesc($productDesc)
    {
        $this->productDesc = $productDesc;
    }


    /**
     * @param \DateTime $adder
     */
    public function setAdder($adder)
    {
        $this->adder = $adder;
    }

    /**
     * @param \DateTime $discontinued
     */
    public function setDiscontinued($discontinued)
    {
        $this->discontinued = $discontinued;
    }

    /**
     * @param int $stockLevel
     */
    public function setStockLevel($stockLevel)
    {
        $this->stockLevel = $stockLevel;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }


    /**
     *
     */
    public function setTimestamp()
    {
        $this->timestamp = new \DateTime();
    }

}

