<?php

namespace App\Twig;


use App\Entity\MatchDetails;
use Twig_Function;
use Unirest\Request;

class AppExtension extends \Twig_Extension
{

    public function getFunctions()
    {
        /**
         * @return array|\Twig_Extension[]
         */
        return [
            new Twig_Function('getMatch', [$this, 'getMatch'])
//            new Twig_Function('render', [$this, 'render'], ['is_safe' => ['html']])
        ];
    }

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

    public function getMatch($idMatch)
    {

        $idMatch = $idMatch->fixture_id;
        // foreach pour bouclé les données récupère via le json_decode et pouvoir les utilisé
        $fixturesArray = [];
        foreach ($this->getFixture($idMatch) as $fixtures) {
            $fixtures = reset($fixtures['fixtures']);
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

    public const NB_SUMMARY_CHAR = 150;

    public function getFilters()
    {
        return [
            new \Twig_Filter('summary', function($text) {

                # Supprimer les balises HTML
                $string = strip_tags($text);

                # Si ma chaine est supérieur à 150...
                # je poursuis, sinon c'est inutile
                if( strlen($string) > self::NB_SUMMARY_CHAR ) {

                    # Je coupe ma chaine à 150
                    $stringCut = substr($string, 0 , self::NB_SUMMARY_CHAR);

                    # Je m'assure de ne pas couper de mot
                    $string = substr($stringCut, 0, strrpos($stringCut, ' ')). '...';

                }

                # On retourne l'accroche
                return $string;

            },['is_safe'=>['html']])
        ];
    }
}