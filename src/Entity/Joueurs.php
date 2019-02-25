<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JoueursRepository")
 */
class Joueurs
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
    private $Number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Player;

    /**
     * Joueurs constructor.
     * @param $Number
     * @param $Player
     */
    public function __construct($Number, $Player)
    {
        $this->Number = $Number;
        $this->Player = $Player;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->Number;
    }

    public function setNumber(string $Number): self
    {
        $this->Number = $Number;

        return $this;
    }

    public function getPlayer(): ?string
    {
        return $this->Player;
    }

    public function setPlayer(string $Player): self
    {
        $this->Player = $Player;

        return $this;
    }
}
