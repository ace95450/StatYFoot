<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventsRepository")
 */
class Events
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $elapsed;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $teamName;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $player;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $detail;

    /**
     * Events constructor.
     * @param $elapsed
     * @param $teamName
     * @param $player
     * @param $type
     * @param $detail
     */
    public function __construct($elapsed, $teamName, $player, $type, $detail)
    {
        $this->elapsed = $elapsed;
        $this->teamName = $teamName;
        $this->player = $player;
        $this->type = $type;
        $this->detail = $detail;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getElapsed(): ?int
    {
        return $this->elapsed;
    }

    public function setElapsed(int $elapsed): self
    {
        $this->elapsed = $elapsed;

        return $this;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): self
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getPlayer(): ?string
    {
        return $this->player;
    }

    public function setPlayer(string $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }
}
