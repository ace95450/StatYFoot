<?php
/**
 * Created by PhpStorm.
 * User: brice
 * Date: 20/02/2019
 * Time: 17:05
 */

namespace App\Controller;


use App\Entity\Leagues;
use App\Entity\Standings;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Unirest\Request;

class LeagueController extends AbstractController
{
    /**
     * @Route("/league/{id<\d+>}")
     */
    public function League($id)
    {
        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/leagues/league/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        // json_decode pour récuperer les données json
        $raw_body = json_decode($response->raw_body, true);

        // foreach pour bouclé les données récupère via le json_decode et pouvoir les utilisé
        $oneleagueArray = [];
        foreach ($raw_body['api']['leagues'] as $league) {
            $newleague = new Leagues(
                $league['league_id'],
                $league['name'],
                $league['country'],
                $league['season'],
                $league['season_start'],
                $league['season_end'],
                $league['logo'],
                $league['standings']
            );
            $oneleagueArray[] = $newleague;

            // Le classement de la ligue
            Request::verifyPeer(false);
            $response_standings =  Request::get("https://api-football-v1.p.rapidapi.com/leagueTable/".$id."", [
                "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
            ]);

            $raw_standings = json_decode($response_standings->raw_body, true);


            $standingsArray = [];
            foreach ($raw_standings['api']['standings']['0'] as $fixtures) {
                $detailsStandings = new Standings(
                    $fixtures['rank'],
                    $fixtures['team_id'],
                    $fixtures['teamName'],
                    $fixtures['matchsPlayed'],
                    $fixtures['win'],
                    $fixtures['draw'],
                    $fixtures['lose'],
                    $fixtures['goalsFor'],
                    $fixtures['goalsAgainst'],
                    $fixtures['goalsDiff'],
                    $fixtures['points'],
                    $fixtures['lastUpdate']
                );
                $standingsArray[] = $detailsStandings;
            }

            // Les images des équipes
            Request::verifyPeer(false);
            $response_standings =  Request::get("https://api-football-v1.p.rapidapi.com/teams/league/".$id."", [
                "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
            ]);

            $raw_teams = json_decode($response_standings->raw_body, true);


            $TeamArray = [];
            $em=$this->getDoctrine()->getManager();



            foreach ($raw_teams['api']['teams'] as $teams) {
                $detailsTeam= new Teams(
                $teams['team_id'],
                $teams['name'],
                $teams['logo']
                );

                $em->persist($detailsTeam);
                $em->flush();

                $TeamArray[] = $detailsTeam;
            }

            $teamteam = $this->getDoctrine()
                ->getRepository(Teams::class)
                ->find($id);
            dump($teamteam);

            return $this->render("front/league.html.twig", [
                "league" => $oneleagueArray,
                "classement" => $standingsArray,
                "teams" => $teamteam
            ]);
        }
    }
}