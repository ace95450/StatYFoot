<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AllMatchLeagueRepository")
 */
class AllMatchLeague
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
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $halftime_score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $final_score;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $penalty;

    /**
     * @ORM\Column(type="integer")
     */
    private $elapsed;

    /**
     * AllMatchLeague constructor.
     * @param $fixture_id
     * @param $league_id
     * @param $round
     * @param $homeTeam_id
     * @param $awayTeam_id
     * @param $homeTeam
     * @param $awayTeam
     * @param $status
     * @param $statusShort
     * @param $goalsHomeTeam
     * @param $goalsAwayTeam
     * @param $halftime_score
     * @param $final_score
     * @param $penalty
     * @param $elapsed
     */
    public function __construct($fixture_id, $league_id, $round, $homeTeam_id, $awayTeam_id, $homeTeam, $awayTeam, $status, $statusShort, $goalsHomeTeam, $goalsAwayTeam, $halftime_score, $final_score, $penalty, $elapsed)
    {
        $this->fixture_id = $fixture_id;
        $this->league_id = $league_id;
        $this->round = $round;
        $this->homeTeam_id = $homeTeam_id;
        $this->awayTeam_id = $awayTeam_id;
        $this->homeTeam = $homeTeam;
        $this->awayTeam = $awayTeam;
        $this->status = $status;
        $this->statusShort = $statusShort;
        $this->goalsHomeTeam = $goalsHomeTeam;
        $this->goalsAwayTeam = $goalsAwayTeam;
        $this->halftime_score = $halftime_score;
        $this->final_score = $final_score;
        $this->penalty = $penalty;
        $this->elapsed = $elapsed;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFixture_id(): ?int
    {
        return $this->fixture_id;
    }

    public function setFixture_id(int $fixture_id): self
    {
        $this->fixture_id = $fixture_id;

        return $this;
    }

    public function getEventDate()
    {
        return $this->event_date;
    }

    public function setEventDate($event_date): self
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

    public function setStatusShort(?string $statusShort): self
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

    public function setHalftimeScore(?string $halftime_score): self
    {
        $this->halftime_score = $halftime_score;

        return $this;
    }

    public function getFinalScore(): ?string
    {
        return $this->final_score;
    }

    public function setFinalScore(?string $final_score): self
    {
        $this->final_score = $final_score;

        return $this;
    }

    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    public function setPenalty(?string $penalty): self
    {
        $this->penalty = $penalty;

        return $this;
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
}
