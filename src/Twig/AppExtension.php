<?php

namespace App\Twig;


use App\Entity\MatchDetails;
use Twig_Function;
use Unirest\Request;

class AppExtension extends \Twig_Extension
{

    private $matches;

    public function getFixture($id)
    {
        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/id/".$id."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        // json_decode pour récuperer les données json
        return json_decode($response->raw_body, true);
    }

    public function getFunctions()
    {
        /**
         * @return array|\Twig_Extension[]
         */
        return [
            new Twig_Function('getMatch', [$this, 'getMatch']),
            new Twig_Function('render', [$this, 'render'], ['is_safe' => ['html']])
        ];
    }

    public function getMatch($idMatch)
    {

//        dump($idMatch);
//        die();
        $idMatch = $idMatch->fixture_id;
        // foreach pour bouclé les données récupère via le json_decode et pouvoir les utilisé
        $fixturesArray = [];
        foreach ($this->getFixture($idMatch) as $fixtures) {
            $fixtures = reset($fixtures['fixtures']);
            dump($fixtures['fixture_id']);
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
                )
                ;
                if ($fixtures['fixture_id'] == $idMatch) {
                    $fixturesArray[] = $detailsmatch;
                }
            }
        return $fixturesArray;
        }
}