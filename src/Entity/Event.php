<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Normalizer\NormalizableInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event implements NormalizableInterface
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

    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="event", cascade={"remove"})
     */
    private $products;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"insertion"})
     * @var object
     * @Assert\Image(maxSize = "2M",minWidth="200", minHeight="200")
     */
    private $image;

    public function normalize(NormalizerInterface $serializer, $format = null, array $context = array()): array
    {
        return [
            'name' => $this->getName(),
            'place' => $this->getPlace(),
            'opening_date' => $this->getOpeningDate(),
            'closing_date' => $this->getClosingDate(),
            'description' => $this->getDescription(),
            'phone' => $this->getPhone(),
            'website' => $this->getWebsite(),
            'image' => $this->getImage(),
            'theme' => $this->getTheme()
        ];
    }

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * @Groups({"searchable"})
     */
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

    /**
     * @Groups({"searchable"})
     */
    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * @Groups({"searchable"})
     */
    public function getOpeningDate(): DateTimeInterface
    {
        return $this->opening_date;
    }


    public function setOpeningDate(DateTimeInterface $opening_date): self
    {
        $this->opening_date = $opening_date;

        return $this;
    }

    /**
     * @Groups({"searchable"})
     */
    public function getClosingDate(): DateTimeInterface
    {
        return $this->closing_date;
    }

    public function setClosingDate(DateTimeInterface $closing_date): self
    {
        $this->closing_date = $closing_date;

        return $this;
    }

    /**
     * @Groups({"searchable"})
     */
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @Groups({"searchable"})
     */
    public function getTheme()
    {
        return $this->theme;
    }

    public function setTheme(string $theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * @Groups({"searchable"})
     */
    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @Groups({"searchable"})
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @Groups({"searchable"})
     */
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }


}
