<?php

namespace App\Controller;


use App\Entity\MatchDetails;
use App\Entity\Matchdirect;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Unirest\Request;


class FrontController extends AbstractController
{
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(MatchDetails::class);
        $matchDay = $repository->findAll();


        $date = date('Y-m-d');
//        dump($date);

        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/date/" . $date . "", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        // json_decode pour récuperer les données json
        $raw_body = json_decode($response->raw_body, true);
//        dump($raw_body);

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


        $responseDirect = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/live", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_match = json_decode($responseDirect->raw_body, true);
//       dump($raw_match);
        $matchdirectArray = [];
        foreach ($raw_match['api']['fixtures'] as $fixture) {
            $matchDirect = new Matchdirect(
                $fixture['fixture_id'],
                $fixture['event_timestamp'],
                new \DateTime($fixture['event_date']),
                $fixture['league_id'],
                $fixture['round'],
                $fixture['homeTeam_id'],
                $fixture['awayTeam_id'],
                $fixture['homeTeam'],
                $fixture['awayTeam'],
                $fixture['status'],
                $fixture['statusShort'],
                $fixture['goalsHomeTeam'],
                $fixture['goalsAwayTeam'],
                $fixture['halftime_score'],
                $fixture['final_score'],
                $fixture['penalty'],
                $fixture['elapsed'],
                $fixture['firstHalfStart'],
                $fixture['secondHalfStart']
            );
            $matchdirectArray[] = $matchDirect;
        }

        # Sauvegarde en BDD
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        // Passage à la vue
        return $this->render('front/home.html.twig', [
            'fixtures' => $fixturesArray,
            'matchLive' => $matchdirectArray,
            'matchDay' => $matchDay
        ]);
    }

    public function teams($idTeam)
    {
        $response = Request::get("https://api-football-v1.p.rapidapi.com/teams/team/".$idTeam."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_team = json_decode($response->raw_body, true);
        dump($raw_team);

        $teamArray = [];
        foreach ($raw_team['api']['teams'] as $featuresTeam) {
            $infoTeams = new Teams(
                $featuresTeam['team_id'],
                $featuresTeam['name'],
                $featuresTeam['logo']
            );
            $teamArray[] = $infoTeams;
        }
        return $this->render('front/home.html.twig', [
           'teams' => $teamArray
        ]);
    }
}
