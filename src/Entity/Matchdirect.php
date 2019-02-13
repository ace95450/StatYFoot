<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchdirectRepository")
 */
class Matchdirect
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
    private $fixture_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $event_timestamp;

    /**
     * @ORM\Column(type="datetime")
     */
    private $event_date;

    /**
     * @ORM\Column(type="integer")
     */
    private $league_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $round;

    /**
     * @ORM\Column(type="integer")
     */
    private $homeTeam_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $awayTeam_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $homeTeam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $awayTeam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statusShort;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsHomeTeam;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsAwayTeam;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $halftime_score;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $final_score;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $penalty;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $elapsed;

    /**
     * @ORM\Column(type="integer")
     */
    private $firstHalfStart;

    /**
     * @ORM\Column(type="integer")
     */
    private $secondHalfStart;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFixtureId(): ?int
    {
        return $this->fixture_id;
    }

    public function setFixtureId(int $fixture_id): self
    {
        $this->fixture_id = $fixture_id;

        return $this;
    }

    public function getEventTimestamp(): ?int
    {
        return $this->event_timestamp;
    }

    public function setEventTimestamp(int $event_timestamp): self
    {
        $this->event_timestamp = $event_timestamp;

        return $this;
    }

    public function getEventDate(): ?\DateTimeInterface
    {
        return $this->event_date;
    }

    public function setEventDate(\DateTimeInterface $event_date): self
    {
        $this->event_date = $event_date;

        return $this;
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

    public function getRound(): ?string
    {
        return $this->round;
    }

    public function setRound(string $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getHomeTeamId(): ?int
    {
        return $this->homeTeam_id;
    }

    public function setHomeTeamId(int $homeTeam_id): self
    {
        $this->homeTeam_id = $homeTeam_id;

        return $this;
    }

    public function getAwayTeamId(): ?int
    {
        return $this->awayTeam_id;
    }

    public function setAwayTeamId(int $awayTeam_id): self
    {
        $this->awayTeam_id = $awayTeam_id;

        return $this;
    }

    public function getHomeTeam(): ?string
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(string $homeTeam): self
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }

    public function getAwayTeam(): ?string
    {
        return $this->awayTeam;
    }

    public function setAwayTeam(string $awayTeam): self
    {
        $this->awayTeam = $awayTeam;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStatusShort(): ?string
    {
        return $this->statusShort;
    }

    public function setStatusShort(string $statusShort): self
    {
        $this->statusShort = $statusShort;

        return $this;
    }

    public function getGoalsHomeTeam(): ?int
    {
        return $this->goalsHomeTeam;
    }

    public function setGoalsHomeTeam(int $goalsHomeTeam): self
    {
        $this->goalsHomeTeam = $goalsHomeTeam;

        return $this;
    }

    public function getGoalsAwayTeam(): ?int
    {
        return $this->goalsAwayTeam;
    }

    public function setGoalsAwayTeam(int $goalsAwayTeam): self
    {
        $this->goalsAwayTeam = $goalsAwayTeam;

        return $this;
    }

    public function getHalftimeScore(): ?string
    {
        return $this->halftime_score;
    }

    public function setHalftimeScore(string $halftime_score): self
    {
        $this->halftime_score = $halftime_score;

        return $this;
    }

    public function getFinalScore(): ?string
    {
        return $this->final_score;
    }

    public function setFinalScore(string $final_score): self
    {
        $this->final_score = $final_score;

        return $this;
    }

    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    public function setPenalty(string $penalty): self
    {
        $this->penalty = $penalty;

        return $this;
    }

    public function getElapsed(): ?string
    {
        return $this->elapsed;
    }

    public function setElapsed(string $elapsed): self
    {
        $this->elapsed = $elapsed;

        return $this;
    }

    public function getFirstHalfStart(): ?int
    {
        return $this->firstHalfStart;
    }

    public function setFirstHalfStart(int $firstHalfStart): self
    {
        $this->firstHalfStart = $firstHalfStart;

        return $this;
    }

    public function getSecondHalfStart(): ?int
    {
        return $this->secondHalfStart;
    }

    public function setSecondHalfStart(int $secondHalfStart): self
    {
        $this->secondHalfStart = $secondHalfStart;

        return $this;
    }
}
