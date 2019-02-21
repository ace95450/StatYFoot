<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountriesRepository")
 */
class Countries
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
<<<<<<< HEAD
     * @ORM\Column(type="string", length=80)
     * @ORM\OneToMany()(targetEntity="App\Entity\Leagues",
     * mappedBy="country")
=======
     * @ORM\Column(type="string", length=255, nullable=true)
>>>>>>> chris
     */
    private $name;

    /**
     * Countries constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
