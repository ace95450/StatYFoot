<?php
/**
 * Created by PhpStorm.
 * User: brice
 * Date: 22/02/2019
 * Time: 12:48
 */

namespace App\Controller;


use App\Entity\Joueurs;
use App\Entity\MatchDetails;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Unirest\Request;

class TeamController extends AbstractController
{
    /**
     * @Route("/team/{id<\d+>}")
     */
    public function TeamUnique($id)
    {
        // Les images des équipes
        Request::verifyPeer(false);
        $response_standings =  Request::get("https://api-football-v1.p.rapidapi.com/teams/team/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_teams = json_decode($response_standings->raw_body, true);

        $TeamArray = [];
        foreach ($raw_teams['api']['teams'] as $teams) {
            $detailsTeam= new Teams(
                $teams['team_id'],
                $teams['name'],
                $teams['logo']
            );
            $TeamArray[] = $detailsTeam;
        }

        // Tout les match d'une équipe
        $matchEquipe = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/team/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_match = json_decode($matchEquipe->raw_body, true);
        $MatchArray = [];
        foreach ($raw_match['api']['fixtures'] as $fixtures){
            $allMatch = new MatchDetails(
                $fixtures['fixture_id'],
                $fixtures['event_date'],
                $fixtures['league_id'],
                $fixtures['round'],
                $fixtures['homeTeam_id'],
                $fixtures['awayTeam_id'],
                $fixtures['homeTeam'],
                $fixtures['awayTeam'],
                $fixtures['status'],
                $fixtures['statusShort'],
                $fixtures['goalsHomeTeam'],
                $fixtures['goalsAwayTeam'],
                $fixtures['halftime_score'],
                $fixtures['final_score'],
                $fixtures['penalty'],
                $fixtures['elapsed'],
                $fixtures['firstHalfStart'],
                $fixtures['secondHalfStart']
            );
            $MatchArray[] = $allMatch;
        }

        // Les joueurs d'une équipe
        $players =  Request::get("https://api-football-v1.p.rapidapi.com/players/2018/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);
        $raw_players = json_decode($players->raw_body, true);
        $playerArray = [];
        foreach($raw_players['api']['players'] as $fixturesP){
            $allPlayer = new Joueurs(
                $fixturesP['number'],
                $fixturesP['player']
            );
            $playerArray[] = $allPlayer;
        }

            return $this->render("front/team.html.twig", [
                "teams" => $TeamArray,
                "match" => $MatchArray,
                "players" => $playerArray
            ]);
     }

}