<?php
/**
 * Created by PhpStorm.
 * User: brice
 * Date: 20/02/2019
 * Time: 17:05
 */

namespace App\Controller;


use App\Entity\AllMatchLeague;
use App\Entity\Leagues;
use App\Entity\MatchDetails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Unirest\Request;

class LeagueController extends AbstractController
{
    /**
     * @param $id
     * @return Response
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
        }

        //Tout les match d'une league
        $rmatchLeague = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/league/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);
        //dump($rmatchLeague);

        $raw_matchL = json_decode($rmatchLeague->raw_body, true);
        $allMatchInOneLeague = [];
        dump($raw_matchL);
        foreach($raw_matchL['api']['fixtures'] as $fixturesMatch) {
            $allMatchLeague = new AllMatchLeague(
                $fixturesMatch['fixture_id'],
                $fixturesMatch['event_date'],
                $fixturesMatch['league_id'],
                $fixturesMatch['round'],
                $fixturesMatch['homeTeam_id'],
                $fixturesMatch['awayTeam_id'],
                $fixturesMatch['homeTeam'],
                $fixturesMatch['awayTeam'],
                $fixturesMatch['status'],
                $fixturesMatch['statusShort'],
                $fixturesMatch['goalsHomeTeam'],
                $fixturesMatch['goalsAwayTeam'],
                $fixturesMatch['halftime_score'],
                $fixturesMatch['final_score'],
                $fixturesMatch['penalty'],
                $fixturesMatch['elapsed']
            );
            $allMatchInOneLeague[] = $allMatchLeague;
        }

        dump($allMatchInOneLeague);


        // Sauvegarde en BDD
//        FIXME : Not working DateTime Error
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($allMatchLeague);
//        $em->persist($newleague);
//        $em->flush();

        return $this->render("front/league.html.twig", [
            "league" => $oneleagueArray,
            "match" => $allMatchInOneLeague
        ]);
    }
}