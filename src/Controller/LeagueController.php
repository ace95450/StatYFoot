<?php
/**
 * Created by PhpStorm.
 * User: brice
 * Date: 20/02/2019
 * Time: 17:05
 */

namespace App\Controller;


use App\Entity\Leagues;
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

            return $this->render("front/league.html.twig", [
                "league" => $oneleagueArray
            ]);
        }
    }
}