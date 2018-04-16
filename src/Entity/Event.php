<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="events")
     * @var type User owner
     * 
     */
    private $owner;

    /**
     *
     * @ORM\Column(type="text") 
     */
     private $description;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $place;

    /**
     * @ORM\Column(type="datetime")
     */
    private $opening_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $closing_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $theme;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $website;
    

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner(User $owner)
    {
        $this->owner = $owner;

        return $this;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getOpeningDate(): DateTimeInterface
    {
        return $this->opening_date;
    }

    public function setOpeningDate(DateTimeInterface $opening_date): self
    {
        $this->opening_date = $opening_date;

        return $this;
    }

    public function getClosingDate(): DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(DateTimeInterface $closing_date): self
    {
        $this->closing_date = $closing_date;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function setTheme(string $theme)
    {
        $this->theme = $theme;

        return $this;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }
    
    public function getDescription()
    {
       return $this->description;
    }
    
    public function setDescription(string $description):self
    {
        $this->description = $description;
        
        return $this;
    }
}
