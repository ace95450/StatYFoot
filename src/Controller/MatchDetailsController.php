<?php

namespace App\Controller;


use App\Entity\Events;
use App\Entity\LineUps;
use App\Entity\MatchDetails;
use App\Entity\Standings;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Unirest\Request;

class MatchDetailsController extends AbstractController
{
    /**
     * @Route("/details-match/{id<\d+>}")
     */
    public function detailsMatch($id)
    {
        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/id/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);
        //dump($response);

        // json_decode pour récuperer les données json
        $raw_body = json_decode($response->raw_body, true);
//       dump($raw_body);

        // foreach pour bouclé les données récupère via le json_decode et pouvoir les utilisé
        $fixturesArray = [];
        foreach ($raw_body['api']['fixtures'] as $fixtures) {
            $detailsmatch = new MatchDetails(
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
            $fixturesArray[] = $detailsmatch;
        }

        // Tout ce qui concerne les évenements du match
        Request::verifyPeer(false);
        $rEvent = Request::get("https://api-football-v1.p.rapidapi.com/events/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);
//        dump($rEvent);

        $raw_events = json_decode($rEvent->raw_body, true);
        $eventsArray = [];
        foreach ($raw_events['api']['events'] as $events) {
            $eventsMatch = new Events(
                $events['elapsed'],
                $events['teamName'],
                $events['player'],
                $events['type'],
                $events['detail']
            );
            $eventsArray[] = $eventsMatch;
        }

        // Le classement de la ligue
        Request::verifyPeer(false);
        $response_standings =  Request::get("https://api-football-v1.p.rapidapi.com/leagueTable/4", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_standings = json_decode($response_standings->raw_body, true);
//        dump($response_standings);

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

        // La compositions des équipes du match
        Request::verifyPeer(false);
        $rLineups = Request::get("https://api-football-v1.p.rapidapi.com/lineups/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_lineups = json_decode($rLineups->raw_body, true);
//        dump($raw_lineups);

        foreach($raw_lineups['api']['lineUps'] as $fixLine) {
        }


        // Sauvegarde en BDD
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        // Passage à la vue
        return $this->render('front/details.html.twig', [
            'fixtures' => $fixturesArray,
            'events' => $eventsArray,
            "standings" => $standingsArray
        ]);
    }

}