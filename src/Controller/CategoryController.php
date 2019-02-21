<?php
/**
 * Created by PhpStorm.
 * User: brice
 * Date: 18/02/2019
 * Time: 16:29
 */

namespace App\Controller;


use App\Entity\Countries;
use App\Entity\Leagues;
use App\Entity\MatchDetails;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Unirest\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/todaymatch")
     */
    public function categoryTodayMatch()
    {
        //Affiche tous les matchs du jours
        $date = date('Y-m-d');


        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/date/" . $date . "", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        // json_decode pour récuperer les données json
        $raw_body = json_decode($response->raw_body, true);


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
        //Afficher les logos
        $response = Request::get("https://api-football-v1.p.rapidapi.com/teams/team/76", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_team = json_decode($response->raw_body, true);

        $teamArray = [];
        foreach ($raw_team['api']['teams'] as $featuresTeam) {
            $infoTeams = new Teams(
                $featuresTeam['team_id'],
                $featuresTeam['name'],
                $featuresTeam['logo']
            );
            $teamArray[] = $infoTeams;
        }

        // Vue
        return $this->render("category/todaymatch.html.twig", [
            "viewtodaymatch" => $fixturesArray,
            "teamcategory" => $teamArray,

        ]);


    }
    /**
     * @Route("/category/leagues")
     */
    public function categoryLeagues()
    {
        // Appel de toutes les ligues
       Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/leagues/season/2018", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_league = json_decode($response->raw_body, true);

        $leagueArray = [];
        foreach ($raw_league['api']['leagues'] as $featureLeague) {
            $infoLeague = new Leagues(
                $featureLeague["league_id"],
                $featureLeague["name"],
                $featureLeague["country"],
                $featureLeague["season"],
                $featureLeague["season_start"],
                $featureLeague["season_end"],
                $featureLeague["logo"],
                $featureLeague["standings"]

            );
            $leagueArray[] = $infoLeague;
        }


        return $this->render("category/league.html.twig", [
            "leaguecategory" => $leagueArray
        ]);
    }


    /**
     * @Route("/category/country")
     */
    public function categoryCountries()
    {
        // Appel de tous les pays
        $response = Request::get("https://api-football-v1.p.rapidapi.com/countries", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        $raw_country = json_decode($response->raw_body, true);
        dump($raw_country);


        $countryArray = [];
        foreach ($raw_country['api']['countries'] as $featureCountry) {
            $infoCountry = new Countries(
                $featureCountry["name"]
            );
            $countryArray[] = $infoCountry;
        }
        return $this->render("category/country.html.twig", [
            "countrycategory" => $countryArray
        ]);
    }
}