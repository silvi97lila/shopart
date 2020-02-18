<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productName;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="string")
     */
    private $card_nr;

    /**
     * @ORM\Column(type="string")
     */
    private $cvv;

    /**
     * @ORM\Column(type="string")
     */
    private $exp_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;



    public function __construct()
    {
        $this->purchase=new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getCardNr()
    {
        return $this->card_nr;
    }

    /**
     * @param mixed $card_nr
     */
    public function setCardNr($card_nr): void
    {
        $this->card_nr = $card_nr;
    }

    /**
     * @return mixed
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param mixed $cvv
     */
    public function setCvv($cvv): void
    {
        $this->cvv = $cvv;
    }

    /**
     * @return mixed
     */
    public function getExpDate()
    {
        return $this->exp_date;
    }

    /**
     * @param mixed $exp_date
     */
    public function setExpDate($exp_date): void
    {
        $this->exp_date = $exp_date;
    }

}
