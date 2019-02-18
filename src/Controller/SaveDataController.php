<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 18/02/2019
 * Time: 14:40
 */

namespace App\Controller;


use App\Entity\MatchDetails;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Unirest\Request;

class SaveDataController extends AbstractController
{
    public function saveData()
    {
        $reposiroty = $this->getDoctrine()->getRepository(Teams::class);
        $reposiroty->findAll();

        //============== MATCH DU JOUR =========================
        $date = date('Y-m-d');

        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/date/" . $date . "", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        // json_decode pour récuperer les données json
        $raw_body = json_decode($response->raw_body, true);
        dump($raw_body);

        // foreach pour bouclé les données récupère via le json_decode et pouvoir les utilisé
        foreach ($raw_body['api']['fixtures'] as $fixtures) {
            $matchDay = new MatchDetails(
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
        }
        //============== FIN MATCH DU JOUR =========================
        //============== TOUTES LES EQUIPES D'UNE LEAGUE =========================

        Request::verifyPeer(false);
        $rTeam = Request::get("https://api-football-v1.p.rapidapi.com/teams/league/4", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_league = json_decode($rTeam->raw_body, true);
        dump($raw_league);

        foreach ($raw_league['api']['teams'] as $featuresTeam) {
            $infoLeague = new Teams(
                $featuresTeam['team_id'],
                $featuresTeam['name'],
                $featuresTeam['logo']
            );
        }
        //============== FIN TOUTES LES LEAGUES =========================

        # Sauvegarde en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($matchDay);
        $em->persist($infoLeague);
        $em->flush();
    }
}