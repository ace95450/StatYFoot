<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 14/02/2019
 * Time: 12:47
 */

namespace App\Controller;


use App\Entity\MatchDetails;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Unirest\Request;

class MatchDetailsController extends AbstractController
{
    /**
     * @Route("/details-match")
     */
    public function detailsMatch()
    {
        $date = date('Y-m-d');
        dump($date);

        // Appelle de l'api ! Request::verifyPeer fait une demande de vérirification du certif SSL
        Request::verifyPeer(false);
        $response = Request::get("https://api-football-v1.p.rapidapi.com/fixtures/date/".$date."", [
            "X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725"
        ]);

        // json_decode pour récuperer les données json
        $raw_body = json_decode($response->raw_body, true);
        dump($raw_body);

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

        # Sauvegarde en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($detailsmatch);
        $em->flush();

        // Passage à la vue
        return $this->render('front/details.html.twig', [
            'fixtures' => $fixturesArray
        ]);
    }

}