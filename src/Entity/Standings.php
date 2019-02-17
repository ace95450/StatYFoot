<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StandingsRepository")
 */
class Standings
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
    private $rank;

    /**
     * @ORM\Column(type="integer")
     */
    private $team_id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $teamName;

    /**
     * @ORM\Column(type="integer")
     */
    private $matchsPlayed;

    /**
     * @ORM\Column(type="integer")
     */
    private $win;

    /**
     * @ORM\Column(type="integer")
     */
    private $draw;

    /**
     * @ORM\Column(type="integer")
     */
    private $lose;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsFor;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsAgainst;

    /**
     * @ORM\Column(type="integer")
     */
    private $goalsDiff;

    /**
     * @ORM\Column(type="integer")
     */
    private $points;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastUpdate;

    /**
     * Standings constructor.
     * @param $rank
     * @param $team_id
     * @param $teamName
     * @param $matchsPlayed
     * @param $win
     * @param $draw
     * @param $lose
     * @param $goalsFor
     * @param $goalsAgainst
     * @param $goalsDiff
     * @param $points
     * @param $lastUpdate
     */
    public function __construct($rank, $team_id, $teamName, $matchsPlayed, $win, $draw, $lose, $goalsFor, $goalsAgainst, $goalsDiff, $points, $lastUpdate)
    {
        $this->rank = $rank;
        $this->team_id = $team_id;
        $this->teamName = $teamName;
        $this->matchsPlayed = $matchsPlayed;
        $this->win = $win;
        $this->draw = $draw;
        $this->lose = $lose;
        $this->goalsFor = $goalsFor;
        $this->goalsAgainst = $goalsAgainst;
        $this->goalsDiff = $goalsDiff;
        $this->points = $points;
        $this->lastUpdate = $lastUpdate;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(int $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getTeamId(): ?int
    {
        return $this->team_id;
    }

    public function setTeamId(int $team_id): self
    {
        $this->team_id = $team_id;

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

    public function getMatchsPlayed(): ?int
    {
        return $this->matchsPlayed;
    }

    public function setMatchsPlayed(int $matchsPlayed): self
    {
        $this->matchsPlayed = $matchsPlayed;

        return $this;
    }

    public function getWin(): ?int
    {
        return $this->win;
    }

    public function setWin(int $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getDraw(): ?int
    {
        return $this->draw;
    }

    public function setDraw(int $draw): self
    {
        $this->draw = $draw;

        return $this;
    }

    public function getLose(): ?int
    {
        return $this->lose;
    }

    public function setLose(int $lose): self
    {
        $this->lose = $lose;

        return $this;
    }

    public function getGoalsFor(): ?int
    {
        return $this->goalsFor;
    }

    public function setGoalsFor(int $goalsFor): self
    {
        $this->goalsFor = $goalsFor;

        return $this;
    }

    public function getGoalsAgainst(): ?int
    {
        return $this->goalsAgainst;
    }

    public function setGoalsAgainst(int $goalsAgainst): self
    {
        $this->goalsAgainst = $goalsAgainst;

        return $this;
    }

    public function getGoalsDiff(): ?int
    {
        return $this->goalsDiff;
    }

    public function setGoalsDiff(int $goalsDiff): self
    {
        $this->goalsDiff = $goalsDiff;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
