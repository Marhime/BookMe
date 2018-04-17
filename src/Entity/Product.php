<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

     /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $price;


    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="products")
     * @var Event event
     */
    private $event;


    private $quantity;

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getEvent(): Event
    {
        return $this->event;
    }

    public function setEvent(Event $event)
    {
        $this->event = $event;
        return $this;
    }


    public function getQuantity()
    {
        return $this->quantity;
    }


    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
    }



}
