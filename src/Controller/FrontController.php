<?php

namespace App\Controller;


use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends AbstractController
{
    public function index()
    {
        $repository = $this->getDoctrine()
            ->getRepository(Membre::class);
        $membre = $repository->findAll();


        //return new Response("<h1>PAGE D'ACCUEIL</h1>");
        return $this->render("front/home.html.twig", [
            'articles' => $membre
        ]);
    }

    public function showApi(Response $response)
    {
        // Récupération de l'api
        $response = Unirest\Request::get("https://api-football-v1.p.rapidapi.com/players/seasons",
            array("X-RapidAPI-Key" => "f9391e3ademsh1e9a775f76d8bc1p198f3ejsnca04e9c35725")
        );

        //
        $obj = json_decode($response, true);

    }
}