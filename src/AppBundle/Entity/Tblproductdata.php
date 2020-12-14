<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tblproductdata
 *
 * @ORM\Table(name="tblProductData", uniqueConstraints={@ORM\UniqueConstraint(name="strProductCode", columns={"strProductCode"})})
 * @ORM\Entity
 */
class Tblproductdata
{
	
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $intproductdataid;

    /**
     * @var string
     *
     * @ORM\Column( type="string", length=50)
     */
    private $strproductname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $strproductdesc;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=10, unique=true)
     */
    private $strproductcode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dtmadded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dtmdiscontinued;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
	 * 
	 * @Gedmo\Timestampable(on="create")
	 *
     */
    private $stmtimestamp;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $stockLevel;

    /**
     * @var string
     *
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;
	
	
	
	/**
	* Set strproductname
	*
	* @return string
	*/
	public function setName($name){
		$this->strproductname = $name;
		return $this;
	}
	
	/**
	* Set strproductcode
	*
	* @return string
	*/
	public function setCode($code){
		$this->strproductcode = $code;
		return $this;
	}
	
	/**
	* Set strproductdesc
	*
	* @return string
	*/
	public function setDescription($description){
		$this->strproductdesc = $description;
		return $this;
	}
	
	/**
	* Set dtmadded
	*
	* @param \DateTime $dtmadded
	*
	* @return Tblproductdata
	*
	*/
	public function setAdder($date){
		$this->dtmadded =  $date;
		return $this;
	}
	
	/**
	* Set dtmdiscontinued
	*
	* @param \DateTime $dtmdiscontinued
	*
	* @return Tblproductdata
	*/
	public function setDiscontinued($date){
		$this->dtmdiscontinued = $date;
		return $this;
	}
	/**
	* Set stmtimestamp
	*
	* @param \DateTime $stmtimestamp
	*
	* @return Tblproductdata
	*/
	public function setStmtimestamp($date){
		$this->stmtimestamp = $date;
		return $this;
	}
	/**
	* Set stockLevel
	*
	* @param integer $stockLevel
	*
	*/
	public function setStock($stock){	
		$this->stockLevel = $stock;
		return $this;
	}
	
	/**
	* Set price
	*
	* @param string $price
	*
	*/
	public function setPrice($price){
		$this->price = $price;
		return $this;
	}
	
}

