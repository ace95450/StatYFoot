<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LeaguesRepository")
 */
class Leagues
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
    private $league_id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=80)   /**
     * @ORM\ManyToOne()(targetEntity="App\Entity\Countries",
     *     inversedBy="name")
     */
    private $country;

    /**
     * @ORM\Column(type="integer")
     */
    private $season;

    /**
     * @ORM\Column(type="datetime")
     */
    private $season_start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $season_end;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $standings;

    /**
     * Leagues constructor.
     * @param $league_id
     * @param $name
     * @param $country
     * @param $season
     * @param $season_start
     * @param $season_end
     * @param $logo
     * @param $standings
     */
    public function __construct($league_id, $name, $country, $season, $season_start, $season_end, $logo, $standings)
    {
        $this->league_id = $league_id;
        $this->name = $name;
        $this->country = $country;
        $this->season = $season;
        $this->season_start = $season_start;
        $this->season_end = $season_end;
        $this->logo = $logo;
        $this->standings = $standings;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeagueId(): ?int
    {
        return $this->league_id;
    }

    public function setLeagueId(int $league_id): self
    {
        $this->league_id = $league_id;

        return $this;
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSeason(): ?int
    {
        return $this->season;
    }

    public function setSeason(int $season): self
    {
        $this->season = $season;

        return $this;
    }

    public function getSeasonStart(): ?\DateTimeInterface
    {
        return $this->season_start;
    }

    public function setSeasonStart(\DateTimeInterface $season_start): self
    {
        $this->season_start = $season_start;

        return $this;
    }

    public function getSeasonEnd(): ?\DateTimeInterface
    {
        return $this->season_end;
    }

    public function setSeasonEnd(\DateTimeInterface $season_end): self
    {
        $this->season_end = $season_end;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getStandings(): ?bool
    {
        return $this->standings;
    }

    public function setStandings(bool $standings): self
    {
        $this->standings = $standings;

        return $this;
    }
}
