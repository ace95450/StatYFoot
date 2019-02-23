<?php
/**
 * Created by PhpStorm.
 * User: brice
 * Date: 22/02/2019
 * Time: 12:48
 */

namespace App\Controller;


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

            return $this->render("front/team.html.twig", [
                "teams" => $TeamArray,

            ]);
        }

}